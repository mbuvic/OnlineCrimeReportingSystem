<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
 
    if (isset($_SESSION['login_type']) && $_SESSION['login_type'] > 0) {
      header("location:admin/");
    }

    include('header.php');

	
    ?>

    <style>
      .bg-dark {
          background-color: #1a1a1a !important;
      }
      #main-field{
        margin-top: 5rem!important;
        animation: fadeIn 0.8s ease-out;
      }
      body * {
        /*font-size: 13px ;*/
      }
      .modal-body  {
        color:black;
      }
      .fr-wrapper {
          color:white;
          background: #ffffff08;
          padding: 1em 1.5em;
          border-radius:5px;
      }

      .masthead{
        background: linear-gradient(to bottom, rgb(0 0 0 / 40%) 0%, rgb(245 242 240 / 45%) 100%), url('admin/assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>') !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        position: relative;
        background-attachment: fixed;
        transition: all 0.5s ease;
      }

      .masthead .container-fluid {
        z-index: 2;
        position: relative;
      }

      .navbar {
        transition: all 0.3s ease;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
      }

      .navbar-brand {
        font-weight: 700;
        transition: all 0.3s ease;
      }

      .navbar-brand:hover {
        transform: translateY(-2px);
      }

      .nav-link {
        position: relative;
        transition: all 0.3s ease;
      }

      .nav-link:after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #fff;
        transition: width 0.3s ease;
      }

      .nav-link:hover:after {
        width: 100%;
      }

      .btn {
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
      }

      .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      }

      .modal {
        animation: modalFade 0.3s ease-out;
      }

      .toast {
        animation: slideIn 0.3s ease-out;
      }

      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }

      @keyframes modalFade {
        from { opacity: 0; transform: translateY(-50px); }
        to { opacity: 1; transform: translateY(0); }
      }

      @keyframes slideIn {
        from { transform: translateX(100%); }
        to { transform: translateX(0); }
      }

      /* Card animations */
      .card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }

      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      }

      /* Footer styling */
      footer {
        background: linear-gradient(to right, #1a1a1a, #2d2d2d);
        color: #fff;
        padding: 3rem 0;
      }

      footer i {
        transition: all 0.3s ease;
      }

      footer i:hover {
        transform: translateY(-5px);
        color: #007bff;
      }
    </style>
    <body id="page-top" class="bg-dark">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <?php if(isset($_SESSION['login_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=complaint_list">My Complaint List</a></li>
                        <div class=" dropdown mr-4">
                            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
                              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                                <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
                              </div>
                        </div>
                      <?php else: ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a></li>
                      <?php endif; ?>
                       
                        
                     
                    </ul>
                </div>
            </div>
        </nav>
  <header class="masthead">
      <div class="container-fluid h-100">
          <div class="row h-100 align-items-center justify-content-center text-center">
              <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Welcome to <?php echo $_SESSION['system']['name']; ?></h3>
                  <hr class="divider my-4" />
              <div class="row mb-2 text-left justify-content-center ">
                 <button class="btn btn-primary" type="button" id="report_crime">Report a Crime/Complaint</button>
              </div>                        
              </div>
              
          </div>
      </div>
  </header>
  <main id="main-field" class="bg-dark">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';

        ?>
        
       
</main>
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class=" py-5 bg-dark">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0 text-white">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                    </div>
                    <?php if(!isset($_SESSION['login_id'])): ?>
                      <div class="col-lg-4 mr-auto text-center">
                          <i class="fas fa-user fa-3x mb-3 text-muted"></i>
                          <a class="d-block" href="admin/">Admin Login</a>
                      </div>
                    <?php endif; ?>
                </div>
            </div>
            <br>
            <div class="container"><div class="small text-center text-muted">Copyright © 2025 - <?php echo $_SESSION['system']['name'] ?> | Ramba Boys' High School</div></div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>
    <script type="text/javascript">
      $('#login').click(function(){
        uni_modal("Login",'login.php')
      })
      $('.datetimepicker').datetimepicker({
          format:'Y-m-d H:i',
      })
      $('#find-car').submit(function(e){
        e.preventDefault()
        location.href = 'index.php?page=search&'+$(this).serialize()
      })
      $('#report_crime').click(function(){
        if('<?php echo !isset($_SESSION['login_id']) ? 1 : 0 ?>'==1){
          uni_modal("Login",'login.php');
          return false;
        }
          uni_modal("Report",'manage_report.php');
      })
      $('#manage_my_account').click(function(){
          uni_modal("Manage Account",'signup.php');
      })
    </script>
    <?php $conn->close() ?>

</html>
