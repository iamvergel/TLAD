 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="../admins/admin_action.php" method="POST">
                 <div class="modal-body">Are you sure you want to logout?</div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtb">No</button>
                     <button type="submit" class="btn btn-success" name="logout_btn">Logout</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <footer class="main-footer">
     <div class="float-right d-none d-sm-block">
         <!-- <b>Version</b> 1.0 -->
     </div>
     <strong>Copyright &copy; <?= date('Y'); ?> <a href="../../../index.php" class="text-success"><?= $system_name ?></a>.</strong> All rights reserved.
 </footer>
 </body>

 </html>