<!DOCTYPE html>
<html>
<head>
    <style>
        html {
            background: #FFFFFF;
        }
        table {
            width: 100%;
        }
        th {
            position: sticky;
            top: 0;
            background-color: #1C2833;
        }
    </style>
</head>
<body>
    @php
        $db_server = "127.0.0.1";
        $db_user = "root";
        $db_password = '********'; 
        $db_name = "laravel";

        try { 
            $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id, time, duration, url, method, input FROM logs"; 
            $statement = $db->prepare($sql); 
            $statement->execute(); 

            $result_array = $statement->fetchAll(); 
        } 
        catch(PDOException $e) { 
            echo "Ошибка при сохранении записи в базе данных: " . $e->getMessage(); 
        } 
    @endphp

    <div class="table"> 
        <table class='table'>
            <thead>
                <tr>
                    <th>id</th>
                    <th>time</th>
                    <th>duration</th>
                    <th>url</th>
                    <th>method</th>
                    <th>input</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result_array as $result_row)
                    <tr>
                        <td align='center'>{{ $result_row['id'] }}</td>
                        <td align='center'>{{ $result_row['time'] }}</td>
                        <td align='center'>{{ $result_row['duration'] }}</td>
                        <td align='center'>{{ $result_row['url'] }}</td>
                        <td align='center'>{{ $result_row['method'] }}</td>
                        <td align='center'>{{ $result_row['input'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @php
        $db = null; 
    @endphp
</body>
</html>
