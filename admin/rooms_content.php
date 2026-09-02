<?php
if(isset($_POST['add_room'])) {
    $room_no = $_POST['room_number'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $conn->query("INSERT INTO rooms (room_number, type, price, status) VALUES ('$room_no', '$type', '$price', '$status')");
    echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $new_status = $_GET['action'] == 'activate' ? 'Available' : 'Inactive';
    $conn->query("UPDATE rooms SET status='$new_status' WHERE id=$id");
    echo "<meta http-equiv='refresh' content='0;url=dashboard.php?page=rooms'>";
}

$rooms = $conn->query("SELECT * FROM rooms");
?>
<h2>Manage Rooms</h2>
<form method="POST" class="row g-3 my-3">
    <div class="col-md-3"><input type="text" name="room_number" class="form-control" placeholder="Room Number" required></div>
    <div class="col-md-3"><input type="text" name="type" class="form-control" placeholder="Room Type (AC/Deluxe)" required></div>
    <div class="col-md-2"><input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required></div>
    <div class="col-md-2">
        <select name="status" class="form-control">
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
            <option value="Inactive">Inactive</option>
        </select>
    </div>
    <div class="col-md-2"><button type="submit" name="add_room" class="btn btn-success w-100">Add Room</button></div>
</form>
<table class="table table-bordered mt-4">
    <thead><tr><th>ID</th><th>Room Number</th><th>Type</th><th>Price</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
        <?php while($row = $rooms->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['room_number']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <?php if($row['status'] == 'Inactive') { ?>
                    <a href="dashboard.php?page=rooms&action=activate&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-success">Activate</a>
                <?php } else { ?>
                    <a href="dashboard.php?page=rooms&action=deactivate&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger">Deactivate</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>