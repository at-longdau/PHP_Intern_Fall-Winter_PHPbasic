<?php
session_start();
    require_once 'connect.php';
    $query = "SELECT * FROM member";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Phan so trang 
    $totalRecords = $stmt->rowCount();
    $recordPerPage = 3;
    $totalPage = ceil($totalRecords/$recordPerPage);
    // Tính $offset
    if(isset($_GET['page'])){
    $currentPage= $_GET['page'];
    } else $currentPage = 1;
    $offset = ($currentPage-1)*$recordPerPage;
    $limit = "LIMIT $offset,$recordPerPage";
    $query = "SELECT * FROM member ".$limit; 
    $result = $conn->prepare($query);
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>List Students</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    </head>
    <body>
        <h1>List</h1>
        <div id="container">
            <h1>Students</h1>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Hobby</th>
                        <th>Avatar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']) ?></td>
                            <td><?php echo htmlspecialchars($user['password']); ?></td>
                            <td><?php echo htmlspecialchars($user['age']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']) ?></td>
                            <td><?php echo htmlspecialchars($user['hobby']); ?></td>
                            <td><img style="width: 200px; height: 200px" src="<?php echo $user['avatar']; ?>" alt="">
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
             <?php
    // Hien thi cac trang
    if($currentPage > 1 && $totalPage > 0){
    echo '<a href="/list.php?page='.($currentPage-1).'&t='.time().'">&larr;</a>';
    }
    
    for($i=1; $i<=$totalPage; $i++){
        echo "<a href='/list.php?page=$i'> ".$i." </a>";
    }
 
    if($currentPage < $totalPage && $totalPage > 1){
  echo '<a href="/list.php?page='.($currentPage+1).'&t='.time().'"&rarr; class = "btn-primary"></a>';
    }
  ?>
</body>
</html>