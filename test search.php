<html>

<head>


</head>

<body>
<?php<nav class="search">
        <ul>
            <li>
                <div class="custom-select" style="width:200px;">
                    <select name="Categorieen">
                        <?php
                        $stockGroupName = mysqli_query($connection, "SELECT StockGroupName FROM stockgroups");
                        while ($row = mysqli_fetch_array($stockGroupName, MYSQLI_ASSOC))
                        {
                            $stock = $row["StockGroupName"];

                            echo '<option type="submit" value="'.$stock.'" name="CAT"></option>';
                        }
                        ?>
                    </select>
                </div>
            </li>
            <li>
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </li>
        </ul>

</body>


</html>