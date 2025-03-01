<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="admin_desktop.php" class="logo-light">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/logo-priyagroup.png" alt="logo" class="logo-lg" height="48">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/logo-sm.png" alt="small logo" class="logo-sm" height="48">
        </a>

        <!-- Brand Logo Dark -->
        <a href="admin_desktop.php" class="logo-dark">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/logo-priyagroup.png" alt="dark logo" class="logo-lg" height="28">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>
    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="account-overview.php" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    <!--<span class="badge bg-primary rounded ms-auto">01</span>-->
                </a>
            </li>

            <li class="menu-title">Services</li>

            <li class="menu-item">
                <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-file"></i></span>
                    <span class="menu-text">All Services category </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuExpages">
                    <ul class="sub-menu">
                    <?

                        $sql_scate = "select * from ngo_service_cate where scate_status='Active' order by scate_id asc  ";  // 
                        $result_scate = db_query($sql_scate);
                        $total_scate = mysqli_num_rows($result_scate);
                        if ($total_scate > 0) {
                        while ($line_scate = mysqli_fetch_array($result_scate)) {
                            $ctr_scate++;

                            $first_service_id = db_scalar("select s_id from ngo_services where s_scate_id='$line_scate[scate_id]' and s_status='Active' order by s_id asc ");
                        ?>
                        <li class="menu-item">
                            <a href="all-services.php?scate_id=<?= ($line_scate['scate_id']); ?>&s_id=<?= $first_service_id ?>" class="menu-link">
                                <span class="menu-text"><?= ($line_scate['scate_name']); ?></span>
                            </a>
                        </li>
                            <? } }?>
                        <!-- <li class="menu-item">
                                    <a href="all-services.php" class="menu-link">
                                        <span class="menu-text">All Services</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="my-services-request.php" class="menu-link">
                                        <span class="menu-text">My Service Request</span>
                                    </a>
                                </li> -->


                    </ul>
                </div>
            </li>



            <li class="menu-title">Profile</li>

            <li class="menu-item">
                <a href="#menuComponentsui" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-cookie"></i></span>
                    <span class="menu-text"> My Profile </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuComponentsui">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="profile_edit.php" class="menu-link">
                                <span class="menu-text">Update Profile</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="psw_edit.php" class="menu-link">
                                <span class="menu-text">Change Password</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="menu-title">Support</li>

            <li class="menu-item">
                <a href="#menuExtendedui" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-briefcase-alt-2"></i></span>
                    <span class="menu-text"> Support Ticket </span>
                    <span class="badge bg-info ms-auto">0</span>
                </a>
                <div class="collapse" id="menuExtendedui">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <span class="menu-text">Inbox</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <span class="menu-text">Create Ticket</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="menu-title">Logout</li>

            <li class="menu-item">
                <a href="logout.php" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Logout </span>
                    <!--<span class="badge bg-primary rounded ms-auto">01</span>-->
                </a>
            </li>



        </ul>
    </div>
</div>