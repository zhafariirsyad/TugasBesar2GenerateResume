<?= $this->extend('backend/main') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Create Work Experience</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/internal/resume_work_experiences/store" method="post">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <a href="/internal/resume_work_experiences" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">User Name</label>
                            <div class="col-sm-10">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" selected disabled>--Select Name--</option>
                                    <?php foreach ($users as $key => $user) : ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('user_id') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Position</label>
                            <div class="col-sm-10">
                                <input type="text" name="position" class="form-control <?= ($validation->hasError('position')) ? 'is-invalid' : '' ?>" id="position" value="<?= old('position') ?>" placeholder="Position">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('position') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="company_name" class="form-control <?= ($validation->hasError('company_name')) ? 'is-invalid' : '' ?>" id="company_name" value="<?= old('company_name') ?>" placeholder="Company Name">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('company_name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="start_date" class="form-control <?= ($validation->hasError('start_date')) ? 'is-invalid' : '' ?>" id="start_date" value="<?= old('start_date') ?>" placeholder="Start Date">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('start_date') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="end_date" class="form-control <?= ($validation->hasError('end_date')) ? 'is-invalid' : '' ?>" id="end_date" value="<?= old('end_date') ?>" placeholder="End Date">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('end_date') ?>
                                </div>
                                <br>
                                <input type="checkbox" id="untill_now" name="untill_now" value="yes">
                                <label for="untill_now"> Until Now?</label><br>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="Jobdesk" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                            <textarea class="form-control <?= ($validation->hasError('about')) ? 'is-invalid' : '' ?>" name="about" id="" style="height:300px;"><?= old('about') ?></textarea>
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('about') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-9"></div>
                            <div class="col-3 d-flex justify-content-end">
                                <button class="btn btn-info btn-lg">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

    <script>
        $(document).ready(function() {
            $('#user_id').select2();
        });
        
    </script>
    <script>
        CKEDITOR.replace( 'about' );
    </script>

<?= $this->endSection() ?>