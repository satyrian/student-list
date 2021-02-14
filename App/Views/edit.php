<?php require_once ROOT . '/../App/Views/static/header.php' ?>
<section class="hero text-center">
    <div class="container">
        <div class="hero__inner row justify-content-center position-relative">
            <div class="col-lg-8">
                <h1 class="hero__title mb-3">Website for registration of abiturients</h1>
                <h2 class="hero__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad cupiditate
                    deleniti doloremque excepturi odit saepe sapiente, sint totam velit voluptatem. Accusamus, animi,
                    distinctio! Delectus neque perferendis rem, unde voluptas voluptates!</h2>
            </div>
        </div>
    </div>
</section>

<div class="edit my-5">
    <div class="container">
        <h3 class="registration__title text-center">Edit your personal information</h3>
        <form action="#" method="post" class="row needs-validation g-3 my-3 mx-lg-5 px-lg-5" novalidate>
            <div class="col-md-6">
                <label for="inputFirstName" class="form-label">First name</label>
                <input type="text" id="inputFirstName" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="inputLastName" class="form-label">Last name</label>
                <input type="text" id="inputLastName" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="inputBirthYear" class="form-label">Birth year</label>
                <input type="number" min="1900" id="inputLastName" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="inputGender" class="form-label">Gender</label>
                <select id="inputGender" class="form-select" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputGroupNumber" class="form-label">Group number</label>
                <input type="text" id="inputGroupNumber" class="form-control" placeholder="Example: 1010Э, 132М, 00123" required>
            </div>
            <div class="col-md-6">
                <label for="inputScore" class="form-label">Score</label>
                <input type="number" min="0" max="1100" id="inputScore" class="form-control" placeholder="Total points for the Unified State Exam" required>
            </div>
            <div class="col-md-6">
                <label for="inputStatus" class="form-label">Status</label>
                <select id="inputStatus" class="form-select" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Resident</option>
                    <option>Nonresident</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="example@gmail.com" required>
            </div>
            <div class="col-md-12">
                <button type="submit" class="registration-btn btn btn-dark px-4 mt-2">Save</button>
            </div>
        </form>
    </div>
</div>
<?php require_once ROOT . '/../App/Views/static/footer.php' ?>