<?php

namespace App\View;

use App\Controller\PostController;

require_once 'controller/PostController.php';

$controller = new PostController();
$posts = $controller->selectPost();

?>


<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="">
      <?php
        foreach ($posts as $post) { ?>
          <div class="my-4 p-4">
            <h3>
              <?php echo $post['post_title']; ?>
            </h3> <hr>
            <img class="img-fluid mx-auto d-block" src="img/demo.png" alt="Chania" width="460" height="345">
            <p class="text-center my-4">
              <?php echo $post['post_body']; ?>
            </p>
            <small>
              Uploaded By <?php echo $post['user_id']; ?>
            </small>

            <div class="text-center mb-4">
              <button class="btn btn-outline-secondary" type="button" name="button" data-toggle="collapse" data-target="#comment<?php echo $post['id']; ?>">
                <small>Comment</small>
              </button>
            </div>

            <div id="comment<?php echo $post['id']; ?>" class="collapse">
              <div class="comment-box">
                <div class="form-group">
                  <textarea class="form-control" name="commentbox" rows="4" cols="80"></textarea>
                  <button class="btn btn-outline-dark mt-3" type="button" name="submit_comment" onclick="submitComment()">
                    <small>Submit Comment</small>
                  </button>
                </div>
              </div>

            </div>

          </div>
          <hr>
      <?php }
      ?>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>


<script>

function submitComment()
{
  alert(123);
}

</script>
