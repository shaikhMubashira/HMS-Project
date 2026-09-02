<?php
// Directly querying the 'registerr' table from the 'client' database
$guests = $conn->query("SELECT * FROM client.registerr");
?>
<h2>Client / Guest List</h2>
<table class="table table-bordered mt-4 align-middle">
    <thead>
        <tr>
            <th>Profile</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Mobile</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $guests->fetch_assoc()) { ?>
        <tr>
            <td>
                <?php if(!empty($row['profile_pic'])) { ?>
                    <img src="../<?php echo $row['profile_pic']; ?>" width="40" height="40" class="rounded-circle" style="object-fit: cover;">
                <?php } else { ?>
                    <span>No Image</span>
                <?php } ?>
            </td>
            <td><?php echo $row['cname']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>