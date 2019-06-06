<?php
if(empty($settings['password'])){
    errors($language['empty_settings_password']);
} else if(!isset($_SESSION['admin']) && !isset($_POST['password'])) {
    ?><form action="" method="post" class="well form-inline">
    <input type="password" class="input-xlarge" name="password" placeholder="<?php echo $language['Please_enter_your_password']; ?>">
    <button type="submit" class="btn"><?php echo $language['Sign_In']; ?></button>
    </form><?php
} else if(isset($_POST['password']) && !isset($_SESSION['admin'])) {
    if(md5(htmlspecialchars_decode($_POST['password'], ENT_QUOTES)) != md5($settings['password'])) {
        redirect('index.php?action=login');
    } else {
        $_SESSION['admin'] = true;
        redirect('index.php?action=Manage_website');
    }
}
?>