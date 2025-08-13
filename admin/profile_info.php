<?php
include "../connection.php";
include "assets/header.php";
include "assets/navbar.php";

// Fetch admin info
$sql1 = "SELECT * FROM `admin_reg` WHERE `adm_id` = '{$_SESSION["adm_id"]}'";
$result1 = mysqli_query($db, $sql1);
$res2 = mysqli_fetch_array($result1);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Profile Info</title>
    <script src="js/sweetalert.js"></script>
</head>

<body>
    <div class="container-fluid">
        <br>
        <div id="profile-position">
            <div class="box-container" id="profile-box">
                <form id="profile" action="" enctype="multipart/form-data" method="POST">
                    <div class="profile-pic">
                        <div class="profile-pic-div">
                            <img id="pfpphoto" 
                                 src="uploads/<?php echo !empty($res2['image']) ? $res2['image'] : 'pfp.png'; ?>" 
                                 alt="Profile Photo">
                            <input type="file" id="pfpfile" accept=".jpg, .jpeg, .png" name="avatar">
                            <label for="pfpfile" id="pfpuploadBtn">
                                <i class="fa fa-camera" style="font-size: 18px; line-height: 35px"></i>
                            </label>
                        </div>
                        <div style="margin-top: 168px;">
                            <p class="font-weight-bold"><?php echo $res2['full_name']; ?> </p>
                            <p class="text-profile-mail"><?php echo $res2['emailid']; ?></p>
                        </div>
                    </div>

                    <div class="profile-info">
                        <div style="padding-left: 10px;">
                            <h4 style="margin-bottom: 20px;">Profile Settings</h4>
                        </div>
                        <div style="padding-left: 10px;">
                            <?php
                            mysqli_data_seek($result1, 0); // Reset result pointer
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = mysqli_fetch_array($result1)) {
                            ?>
                                    <div style="padding-bottom: 5px;">
                                        <label>Name</label>
                                        <input type="text" name="full_name" class="form-control" required value="<?php echo $row['full_name']; ?>">
                                    </div>
                                    <div style="padding-bottom: 5px;">
                                        <label>Contact Number</label>
                                        <input type="number" name="contact" class="form-control" required value="<?php echo $row['contact']; ?>">
                                    </div>
                                    <div style="padding-bottom: 5px;">
                                        <label>Email ID</label>
                                        <input type="email" name="emailid" class="form-control" required value="<?php echo $row['emailid']; ?>">
                                    </div>
                                    <div style="padding-bottom: 20px;">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control" required value="<?php echo $row['password']; ?>">
                                    </div>
                                    <script src="js/password_icon.js"></script>
                            <?php
                                }
                            }
                            ?>
                        </div>
                        <div style="text-align: center; padding-top:10px;">
                            <input style="background-color: #2a498b; border-color:#2e2cc9; height: 38px; width: 120px" 
                                   class="btn btn-primary" type="submit" name="save_profile" value="Save Profile">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    </div>

<?php
if (isset($_POST['save_profile'])) {
    $fname = $_POST['full_name'];
    $emailid = $_POST['emailid'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
    }

    $imageName = $res2['image']; // keep old image by default

    // Handle new file upload
    if (!empty($_FILES['avatar']['name'])) {
        $pfpname = generateRandomString();
        $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $imageName = $pfpname . '.' . $ext;

        $target_dir = __DIR__ . '/uploads/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Delete old image if exists
        if (!empty($res2['image']) && file_exists($target_dir . $res2['image'])) {
            unlink($target_dir . $res2['image']);
        }

        move_uploaded_file($_FILES['avatar']['tmp_name'], $target_dir . $imageName);
    }

    // Update database
    $query = "UPDATE `admin_reg` 
              SET `image`='$imageName', `full_name`='$fname', 
                  `contact`='$contact', `emailid`='$emailid', `password`='$password' 
              WHERE `adm_id`='{$_SESSION['adm_id']}'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        echo "<script>
                swal('Success', 'Profile Updated Successfully', 'success')
                .then(function() { window.location = 'profile_info.php'; });
              </script>";
    } else {
        echo "<script>alert('Error updating profile');</script>";
    }
}
?>

<script type="text/javascript">
    const imgDiv = document.querySelector('.profile-pic-div');
    const img = document.querySelector('#pfpphoto');
    const file = document.querySelector('#pfpfile');
    const uploadBtn = document.querySelector('#pfpuploadBtn');

    imgDiv.addEventListener('mouseenter', function() {
        uploadBtn.style.display = "block";
    });
    imgDiv.addEventListener('mouseleave', function() {
        uploadBtn.style.display = "none";
    });
    file.addEventListener('change', function() {
        const choosedFile = this.files[0];
        if (choosedFile) {
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                img.setAttribute('src', reader.result);
            });
            reader.readAsDataURL(choosedFile);
        }
    });
</script>

</body>
</html>
