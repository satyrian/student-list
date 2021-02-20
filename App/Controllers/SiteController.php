<?php

namespace App\Controllers;

use App\Models\Student;
use App\Models\StudentData;

class SiteController extends Controller
{
    /**
     * Main page
     * @throws \Exception
     */
    public function actionIndex()
    {
        $students = $this->container->get('StudentTableGateway')->getAll();
        $this->show('index', [
            'title' => 'Student list',
            'students' => $students
        ]);
    }

    /**
     * Registration page
     * @throws \Exception
     */
    public function actionRegister()
    {
        $student = new Student();
        $studentData = new StudentData($student);
        $csrfProtection = $this->container->get('csrf');
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $csrfProtection->validate($this->fc->request);
            try {
                $studentData->fill($this->fc->request->getRequestBody());
                $errors = $this->container->get('StudentValidator')->validate($student);

                if (empty($errors)) {
                    $this->container->get('StudentTableGateway')->save($student);
                    header('Location: /');
                    return;
                }
            } catch (\TypeError $error) {
                $errors['type_error'] = true;
            }
        }

        $this->show('register', [
            'title' => 'Add yourself',
            'student' => $student,
            'errors' => $errors,
            'token' => $csrfProtection->setToken()
        ]);
    }
}
