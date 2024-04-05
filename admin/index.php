 <?php
  include_once 'C:\xampp\htdocs\car_rent\shared\functions.php';
  include_once 'C:\xampp\htdocs\car_rent\shared\configDatabase.php';
  auth();
  include_once './shared/head.php';
  include_once './shared/header.php';
  $index = 0;
  $select = "SELECT * FROM `rentsdata` Where `isAvilabe` = 0 AND (`status`='notStart'  OR `status`='still') ";
  $alldata = mysqli_query($con, $select);

  if (isset($_GET['status'])) {
    $id = $_GET['id'];
    $carid = $_GET['carid'];
    if ($_GET['status'] == 'End') {
      $update = "UPDATE `rents` SET `status`='end' WHERE `id`='$id' ";
      $endrent = mysqli_query($con, $update);
      $update = "UPDATE `cars` SET  `is_avilable`= 1 WHERE `id`='$carid' ";
      mysqli_query($con, $update);
      redirect('admin/index.php');
    }
  }
  $totalrevneu = "SELECT SUM(profit_business_owner) AS total_profit FROM `rentsdata` Where `status` = 'end'  ";
  $profits = mysqli_query($con, $totalrevneu);
  $t = mysqli_fetch_assoc($profits);
  $totalprofit = $t['total_profit'];

  ?>
 <div class="pagetitle">
   <h1>Dashboard</h1>
   <nav>
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="<?= url('admin/index.php') ?>">Home</a></li>
       <li class="breadcrumb-item"><a href="<?= url('admin/cars.php') ?>">Cars</a></li>
       <li class="breadcrumb-item"><a href="<?= url('admin/clients.php') ?>">Clients</a></li>
       <li class="breadcrumb-item"><a href="<?= url('admin/CarOwners.php') ?>">Cars Owners</a></li>
     </ol>
   </nav>
 </div><!-- End Page Title -->
 <section class="section dashboard">
   <div class="row">

     <!-- Left side columns -->
     <div class="container-fluid">
       <div class="row">
         <div class="col-lg-12">
           <div class="card info-card ">
             <div class="table-responsive">
               <h5 class="card-title">Rents<span>| Today</span></h5>

               <table class="table text-center">
                 <thead>
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">Client Name</th>
                     <th scope="col">Car Details</th>
                     <th scope="col">Rent time Details</th>
                     <th scope="col">Total Cost</th>
                     <th scope="col">Revenue car Owner</th>
                     <th scope="col">Revenue business Owner</th>
                     <th scope="col"></th>
                   </tr>
                 </thead>
                 <tbody class="table-group-divider">
                   <?php foreach ($alldata as $data) : ?>

                     <tr>
                       <td><?= $index++ ?></th>
                       <td><a href="client.php?id=<?= $data['clientid'] ?>"> <?= $data['clientname'] ?></a></td>
                       <td>
                         <p>carmodel: <?= $data['carmodel'] ?></p>
                         <p>carnumber: <?= $data['carnumber'] ?></p>
                         <a href="car.php?id=<?= $data['carid'] ?>">see more...</a>
                       </td>
                       <td>
                         <p>startdate: <?= $data['startdate'] ?></p>
                         <p>enddate: <?= $data['enddate'] ?></p>

                       </td>
                       <td>
                         <p>total-cost:<?= $data['total_cost'] ?> Le</p>
                       </td>
                       <td><?= profit($data['total_cost'])[0] ?> Le</td>
                       <td><?= profit($data['total_cost'])[1] ?> Le</td>
                       <td><?php if ($data['status'] == 'still') : ?>
                           <a class="btn btn-warning" href="index.php?status=End&carid=<?= $data['carid'] ?>&id=<?= $data['rentid'] ?>">End Rent</a>
                         <?php endif; ?>
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

     <div class="col-lg-8">
       <div class="row">
         <!-- Revenue Card -->
         <div class="col-lg-6 ">
           <div class="card info-card revenue-card">
             <div class="card-body">
               <h5 class="card-title">Revenue <span>| Total</span></h5>

               <div class="d-flex align-items-center">
                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                   <i class="bi bi-currency-dollar"></i>
                 </div>
                 <div class="ps-3">
                   <h6><?= $totalprofit ?> Le</h6>
                 </div>
               </div>
             </div>

           </div>
         </div><!-- End Revenue Card -->

         <!-- Reports -->
         <div class="col-12">
           <div class="card">



             <div class="card-body">
               <h5 class="card-title">Reports <span></span></h5>

             </div>
           </div>
         </div><!-- End Reports -->
         <!-- Top Selling -->
         <div class="col-12">
           <div class="card top-selling overflow-auto">

             <div class="filter">
               <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
               <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                 <li class="dropdown-header text-start">
                   <h6>Filter</h6>
                 </li>

                 <li><a class="dropdown-item" href="#">Today</a></li>
                 <li><a class="dropdown-item" href="#">This Month</a></li>
                 <li><a class="dropdown-item" href="#">This Year</a></li>
               </ul>
             </div>

             <div class="card-body pb-0">
               <h5 class="card-title">Most Rented</h5>

               <table class="table table-borderless">
                 <thead>
                   <tr>
                     <th scope="col">Preview</th>
                     <th scope="col">cars</th>
                     <th scope="col">Car Owner</th>
                     <th scope="col">Cost</th>
                     <th scope="col">Business Revenue</th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr>
                     <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                     <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
                     <td>$64</td>
                     <td class="fw-bold">124</td>
                     <td>$5,828</td>
                   </tr>

                 </tbody>
               </table>

             </div>

           </div>
         </div><!-- End Top Selling -->

       </div>
     </div><!-- End Left side columns -->

     <!-- Right side columns -->
     <!-- <div class="col-lg-4">
       <div class="card">
         <div class="filter">
           <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
           <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
             <li class="dropdown-header text-start">
               <h6>Filter</h6>
             </li>

             <li><a class="dropdown-item" href="#">Today</a></li>
             <li><a class="dropdown-item" href="#">This Month</a></li>
             <li><a class="dropdown-item" href="#">This Year</a></li>
           </ul>
         </div>

         <div class="card-body">
           <h5 class="card-title">Recent Activity <span>| Today</span></h5>

           <div class="activity">

             <div class="activity-item d-flex">
               <div class="activite-label">32 min</div>
               <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
               <div class="activity-content">
                 Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
               </div>
             </div>

             <div class="activity-item d-flex">
               <div class="activite-label">56 min</div>
               <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
               <div class="activity-content">
                 Voluptatem blanditiis blanditiis eveniet
               </div>
             </div>

             <div class="activity-item d-flex">
               <div class="activite-label">2 hrs</div>
               <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
               <div class="activity-content">
                 Voluptates corrupti molestias voluptatem
               </div>
             </div>

             <div class="activity-item d-flex">
               <div class="activite-label">1 day</div>
               <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
               <div class="activity-content">
                 Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
               </div>
             </div>

             <div class="activity-item d-flex">
               <div class="activite-label">2 days</div>
               <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
               <div class="activity-content">
                 Est sit eum reiciendis exercitationem
               </div>
             </div>

             <div class="activity-item d-flex">
               <div class="activite-label">4 weeks</div>
               <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
               <div class="activity-content">
                 Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
               </div>
             </div>
           </div>
         </div>
       </div>
     </div> -->
   </div>
   </div>

   </div>

   </div>
 </section>




 <?php
  include_once './shared/script.php';
  ?>