<?php 
use App\Helper; 
?>

<div class="container mt-3">
<form method="POST" action="<?= Helper::route("/admin/posts/store") ?>">
  <div class="row mb-3">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control postDetails" name="title" id="title"
      <?php if(isset($data['post'])): ?>
        value="<?= $data['post']['title'] ?>"
      <?php endif ?>
      >
    </div>
  </div>
  <div class="row mb-3">
    <label for="text" class="col-sm-2 col-form-label">Text</label>
    <div class="col-sm-10">
      <textarea name="text" cols="20" id="text" rows="3" class="form-control postDetails"><?php if(isset($data['post'])) echo $data['post']['text'] ?></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <label for="category" class="col-form-label col-sm-2 pt-0">Category</label>
    <div class="col-sm-10">
        <select name="category_id" id="category_id" class="form-select postDetails">
            <option value="0">Choose category...</option>
            <?php
            foreach($data["categories"] as $category):
            ?>
            <option 
            value="<?= $category['id'] ?>"
            <?php if(isset($data['post']) &&  $category['id'] == $data['post']['category_id']): ?>
                selected="selected"
            <?php endif ?>
            ><?= $category['category_name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    </div>
    <?php if(isset($data['post'])):?>
    <input type="hidden" class="postDetails" id="id" value="<?= $data['post']['id'] ?>"/>
    <?php endif ?>
  <button type="submit"
    id="<?php if(isset($data['post'])){
        echo "update";
        }
        else{
            echo"post";
        } ?>"
  class="btn btn-primary">
      <?php echo isset($data['post']) ? "Update Post" : "Add Post" ?>
  </button>
</form>
<?php require __DIR__ . "/../components/validation_info.php" ?>
</div>