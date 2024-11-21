<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="container mt-5">
                <h1 class="text-center mb-4">ชุมนุม สกจ.</h1>

                <!-- Stat Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">ชุมนุมทั้งหมด</h5>
                                <h3 class="card-text text-center">12</h3>
                            </div>
                            <div class="card-footer text-center bg-secondary">
                               <a href="<?=base_url('Admin/Acade/DevelopStudents/Clubs/All')?>" class="text-white "> + เพิ่มชุมนุม</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">ลงทะเบียนทั้งหมด</h5>
                                <h3 class="card-text text-center">320</h3>
                            </div>
                            <div class="card-footer text-center bg-secondary">
                               <a href="http://" class="text-white "> ดูทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Activities This Month</h5>
                                <h3 class="card-text text-center">8</h3>
                            </div>
                            <div class="card-footer text-center bg-secondary">
                               <a href="http://" class="text-white "> ดูทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title">รอการอนุมัติ</h5>
                                <h3 class="card-text text-center">5</h3>
                            </div>
                            <div class="card-footer text-center bg-secondary">
                               <a href="http://" class="text-white "> ดูทั้งหมด</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activities Table -->
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        Upcoming Activities
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity Name</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Weekly Music Jam</td>
                                    <td>2024-11-20</td>
                                    <td>Music Room</td>
                                    <td><span class="badge bg-success">Upcoming</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Science Fair Prep</td>
                                    <td>2024-11-25</td>
                                    <td>Lab A</td>
                                    <td><span class="badge bg-info">Scheduled</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Stage Rehearsal</td>
                                    <td>2024-12-05</td>
                                    <td>Auditorium</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>