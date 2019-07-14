<div class="modal fade" id="Modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalLabel">Delete Account?</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-light">Are you sure?</p>
      </div>
      <div class="modal-footer">

      <button type="button" class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" data-dismiss="modal" aria-label="Close">No</button>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form my-2 my-lg-0">
      <a class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" href="del.php" tabindex="-1" role="button">Yes</a>
     </form>
      </div>
    </div>
    </div>
  </div>