<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-cash"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text">$<span class="count">23569</span></div>
                            <div class="stat-heading">Pendapatan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-2">
                        <i class="pe-7s-cart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">3435</span></div>
                            <div class="stat-heading">Penjualan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-4">
                        <i class="pe-7s-user"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">2986</span></div>
                            <div class="stat-heading">Pembeli</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-4">
                        <i class="pe-7s-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"><span class="count">2986</span></div>
                            <div class="stat-heading">Pengunjung</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>


<div class="row">

    <!-- order -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="box-title">Pesanan Yang Belum Dikirim </h4>
            </div>
            <div class="card-body--">
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th class="serial">#</th>
                                <!-- <th class="avatar">Avatar</th> -->
                                <th>ID</th>
                                <th>Name</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="serial">1.</td>
                                <td> #5469 </td>
                                <td> <span class="name">Louis Stanley</span> </td>
                                <td> <span class="product">iMax</span> </td>
                                <td><span class="count">231</span></td>
                                <td class="text-center">
                                    <span class="badge badge-complete">Complete</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- /.table-stats -->
            </div>
        </div> <!-- /.card -->
    </div> <!-- /.col-lg-8 -->
    <!-- /order -->

    <!-- Calender Chart Weather  -->
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <!-- <h4 class="box-title">Chandler</h4> -->
                <div class="calender-cont widget-calender">
                    <div id="calendar"></div>
                </div>
            </div>
        </div><!-- /.card -->
    </div>
    <!-- /Calender Chart Weather -->
</div>


<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 box-title">OS Pengunjung</h4>
                <div class="flot-container">
                    <div id="flot-pie" class="flot-pie-container"></div>
                </div>
            </div>
        </div><!-- /# card -->
    </div><!-- /# column -->
    <!-- live chat -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title box-title">Live Chat</h4>
                <div class="card-content">
                    <div class="messenger-box">
                        <ul>
                            <li>
                                <div class="msg-received msg-container">
                                    <div class="avatar">
                                        <img src="<?= base_url('assets/img/user-profile.png') ?>" alt="">
                                        <div class="send-time">11.11 am</div>
                                    </div>
                                    <div class="msg-box">
                                        <div class="inner-box">
                                            <div class="name">
                                                John Doe
                                            </div>
                                            <div class="meg">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sunt placeat velit ad reiciendis ipsam
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.msg-received -->
                            </li>
                            <li>
                                <div class="msg-sent msg-container">
                                    <div class="avatar">
                                        <img src="<?= base_url('assets/img/user-profile.png') ?>" alt="">
                                        <div class="send-time">11.11 am</div>
                                    </div>
                                    <div class="msg-box">
                                        <div class="inner-box">
                                            <div class="meg">
                                                Hay how are you doing?
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.msg-sent -->
                            </li>
                        </ul>
                        <div class="send-mgs">
                            <div class="yourmsg">
                                <input class="form-control" type="text">
                            </div>
                            <button class="btn msg-send-btn">
                                <i class="pe-7s-paper-plane"></i>
                            </button>
                        </div>
                    </div><!-- /.messenger-box -->
                </div>
            </div> <!-- /.card-body -->
        </div><!-- /.card -->
    </div>
    <!-- /live chat -->

</div>





<!-- Modal - Calendar - Add New Event -->
<div class="modal fade none-border" id="event-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Add New Event</strong></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /#event-modal -->