<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="admin_desktop.php" class="logo-light">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/priya.png" alt="logo" class="logo-lg" height="90" width="150">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/priya.png" alt="small logo" class="logo-sm" height="90"
                width="150">
        </a>

        <!-- Brand Logo Dark -->
        <a href="admin_desktop.php" class="logo-dark">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/priya.png" alt="dark logo" class="logo-lg" height="90"
                width="150">
            <img src="<?= SITE_BACKEND_BASE_URL ?>/images/priya.png" alt="small logo" class="logo-sm" height="90"
                width="150">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">
            <li class="menu-title">Menu</li>
            <li class="menu-item">
                <a href="admin_desktop.php" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    <!--<span class="badge bg-primary rounded ms-auto">01</span>-->
                </a>
            </li>

            <li class="menu-title">Accounts</li>
            <li class="menu-item">
                <a href="customer-list.php" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-calendar"></i></span>
                    <span class="menu-text"> Customer List </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="employee_list.php" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-user"></i></span>
                    <span class="menu-text"> Employee List</span>
                </a>
            </li>
            <li class="menu-title">Services</li>
            <li class="menu-item">
                <a href="#menuExpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-file"></i></span>
                    <span class="menu-text"> Manage Services </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuExpages">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="services_category_list.php" class="menu-link">
                                <span class="menu-text">Services Cate List</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="services_list.php" class="menu-link">
                                <span class="menu-text">Services List</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="faq_list.php" class="menu-link">
                                <span class="menu-text">Manage Faq</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="slider_list.php" class="menu-link">
                                <span class="menu-text">Manage Slider</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="blog_list.php" class="menu-link">
                                <span class="menu-text">Manage Blog</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="document_list.php" class="menu-link">
                                <span class="menu-text">Manage Document</span>
                            </a>
                        </li>

                        <!--  <li class="menu-item">
                                    <a href="manage_requestform_setup.php" class="menu-link">
                                        <span class="menu-text">Manage Request For Setup</span>
                                    </a>
                                </li> -->

                    </ul>


                </div>
            </li>
            <li class="menu-title">Account Settings</li>
            <li class="menu-item">
                <a href="#menuSetpages" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-file"></i></span>
                    <span class="menu-text"> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="menuSetpages">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="profile_edit.php" class="menu-link">
                                <span class="menu-text"> Update Profile</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="psw_edit.php" class="menu-link">
                                <span class="menu-text">Change Password</span>
                            </a>
                            <a href="security_code_edit.php" class="menu-link">
                                <span class="menu-text">Change Security Pass </span>
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