<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Personal Information
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1><?= count($resume_personal_informations); ?> Personal Information</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="/internal/resume_personal_informations/create" class="btn btn-info">Create Personal Information</a>
                        </div>
                    </div>
                    <?= $this->include('backend/includes/alert'); ?>
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>LinkedIn</th>
                                    <th>Profession</th>
                                    <th>Address</th>
                                    <th>About</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resume_personal_informations as $key => $resume_personal_information) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $resume_personal_information['name']; ?></td>
                                        <td><?= $resume_personal_information['email']; ?></td>
                                        <td><?= $resume_personal_information['phone_number']; ?></td>
                                        <td><?= $resume_personal_information['linkedin_url']; ?></td>
                                        <td><?= $resume_personal_information['profession']; ?></td>
                                        <td><?= $resume_personal_information['address']; ?></td>
                                        <td><?= $resume_personal_information['about']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/internal/resume_personal_informations/edit/<?= $resume_personal_information['id'] ?>" class="btn btn-warning white">Edit</a>
                                                <a href="/internal/resume_personal_informations/delete/<?= $resume_personal_information['id'] ?>" class="btn btn-danger btn-delete" data-id="<?= $resume_personal_information['id'] ?>">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script type="text/javascript">
        $(function() {
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                const href = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = href;
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
<?= $this->endSection() ?>