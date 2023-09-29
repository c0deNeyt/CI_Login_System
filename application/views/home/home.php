	<body>
       <h1>Employees</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
<?php
			#if(is_array($data) && ($_SESSION['role'] > 0)){
			$role = $this->session->role;
			$stat = $this->session->loggedIn;
			if (!isset($stat)) {
				header("Location: login");
			}
            if(is_array($data) && ($role > 0)){
                foreach ($data as $key => $value) {
                    echo "            <tr>"."\r\n";
                    echo "                <td>{$value['Name']}</td>"."\r\n";
                    echo "                <td>{$value['Role']}</td>"."\r\n";
                    echo "                <td><a href='#'>Show</a> | <a href='#'>Edit</a> | <a href='#'>Remove</a></td>"."\r\n";
                    echo "            </tr>"."\r\n";
				}
			}
			elseif (is_array($data)){
				foreach ($data as $key => $value) {
                    echo "            <tr>"."\r\n";
                    echo "                <td>{$value['Name']}</td>"."\r\n";
                    echo "                <td>{$value['Role']}</td>"."\r\n";
                    echo "                <td><a href='#'>Show</a></td>"."\r\n";
					echo "            </tr>"."\r\n";
				}
			}
			else{
                echo "            <tr>"."\r\n";
                echo "                <td>Something</td>"."\r\n";
                echo "                <td>Went</td>"."\r\n";
                echo "                <td>Wrong</td>"."\r\n";
                echo "            </tr>"."\r\n";
            }
?>
       </table>
        <a class="add" href="contacts/new">Add New Contact</a>
        <a class="add" href="logout">Logout</a>
    </body>
</html>
