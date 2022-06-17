<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Educations
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1><?= count($resume_educations); ?> Educations</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="/internal/resume_educations/create" class="btn btn-info">Create Education</a>
                        </div>
                    </div>
                    <?= $this->include('backend/includes/alert'); ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Major</th>
                                    <th>School Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Until Now?</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resume_educations as $key => $resume_education) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $resume_education['user_name']; ?></td>
                                        <td><?= $resume_education['major']; ?></td>
                                        <td><?= $resume_education['school_name']; ?></td>
                                        <td><?= $resume_education['start_date']; ?></td>
                                        <td><?= $resume_education['untill_now'] == "yes" ? "-" : $resume_education['end_date']; ?></td>
                                        <td><?= $resume_education['untill_now']; ?></td>
                                        <td><?= $resume_education['about']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/internal/resume_educations/edit/<?= $resume_education['id'] ?>" class="btn btn-warning white">Edit</a>
                                                <a href="/internal/resume_educations/delete/<?= $resume_education['id'] ?>" class="btn btn-danger btn-delete" data-id="<?= $resume_education['id'] ?>">Delete</a>
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