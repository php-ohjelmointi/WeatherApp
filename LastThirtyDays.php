<?php
$status="";
$msg="";
$city="";
$Api_Key = "c3564a06beb32769a104afd908e145b5";
if(isset($_POST['submit'])){
    $city=$_POST['city'];
    $url="http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$Api_Key";
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if($result['cod']==200){
        $status="yes";
    }else{
        $msg=$result['message'];
    }
}
?>

<html lang="en" class=" -webkit-">
   <head>
      <meta charset="UTF-8">
      <title>Weather Card</title>
      <style>
         @import url(https://fonts.googleapis.com/css?family=Poiret+One);
         @import url(https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css);
         body {
         background-color: cadetblue;
         font-family: Poiret One;
         }
         .widget {
         position: absolute;
         top: 50%;
         left: 50%;
         display: flex;
         height: 300px;
         width: 600px;
         transform: translate(-50%, -50%);
         flex-wrap: wrap;
         cursor: pointer;
         border-radius: 20px;
         box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
         }
         .widget .weatherIcon {
         flex: 1 100%;
         height: 60%;
         border-top-left-radius: 20px;
         border-top-right-radius: 20px;
         background: #FAFAFA;
         font-family: weathericons;
         display: flex;
         align-items: center;
         justify-content: space-around;
         font-size: 100px;
         }
         .widget .weatherIcon i {
         padding-top: 30px;
         }
         .widget .weatherInfo {
         flex: 0 0 70%;
         height: 40%;
         background: darkslategray;
         border-bottom-left-radius: 20px;
         display: flex;
         align-items: center;
         color: white;
         }
         .widget .weatherInfo .temperature {
         flex: 0 0 40%;
         width: 100%;
         font-size: 65px;
         display: flex;
         justify-content: space-around;
         }
         .widget .weatherInfo .description {
         flex: 0 60%;
         display: flex;
         flex-direction: column;
         width: 100%;
         height: 100%;
         justify-content: center;
         margin-left:-15px;
         }
         .widget .weatherInfo .description .weatherCondition {
         text-transform: uppercase;
         font-size: 35px;
         font-weight: 100;
         }
         .widget .weatherInfo .description .place {
         font-size: 15px;
         }
         .widget .date {
         flex: 0 0 30%;
         height: 40%;
         background: #70C1B3;
         border-bottom-right-radius: 20px;
         display: flex;
         justify-content: space-around;
         align-items: center;
         color: white;
         font-size: 30px;
         font-weight: 800;
         }
         p {
         position: fixed;
         bottom: 0%;
         right: 2%;
         }
         p a {
         text-decoration: none;
         color: #E4D6A7;
         font-size: 10px;
         }
         .form{
         position: absolute;
         top: 42%;
         left: 50%;
         display: flex;
         height: 300px;
         width: 600px;
         transform: translate(-50%, -50%);
         }
         .text{
         width: 80%;
         padding: 10px
         }
         .submit{
         height: 39px;
         width: 100px;
         border: 0px;
         }
         .mr45{
             margin-right:45px;
         }
         #customers 
         {
            font-family: weathericons;
            border-collapse: collapse;
            width: 100%;
         }

         #customers td         {
            border: 1px solid #ddd;
            padding: 8px;
            font-family: weathericons;
         }
         h5
         {
            font-size: 15px;
            ext-transform: uppercase;
            color: black;
         }
         a{
            text-decoration: none;
            color: red;
            text-transform: uppercase;
         }
         
      </style>
   </head>
   <body>
      
      <div class="form">
         <form style="width:100%;" method="post">
            <a href="index.php"><h5>Current</h5></a>
            <input type="text" class="text" placeholder="Enter city name" name="city" value="<?php echo $city?>"/>
            <input type="submit" value="Submit" class="submit" name="submit"/>
            <?php echo $msg?>
         </form>
      </div>
      
      <?php if($status=="yes"){?>
      <article class="widget">
         <div class="weatherIcon">
            <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@4x.png"/>
         </div>
         <div class="weatherInfo">
            <div class="temperature">
               <span><?php echo round($result['main']['temp']-273.15)?>°</span>
            </div>
            <div class="description mr45">
               <div class="weatherCondition"><?php echo $result['weather'][0]['main']?></div>
               <div class="place"><?php echo $result['name']?></div>
            </div>
            <div class="description">
               <div class="weatherCondition">Wind</div>
               <div class="place"><?php echo $result['wind']['speed']?> M/H</div>
            </div>
         </div>
         <div class="date">
            <?php echo date('d M',$result['dt'])?> 
             
         </div>
         <br>
         <h1 style="text-align: center;">Other Weather information</h1>

<table id="customers">
   <tr>
    <td>Koordinaatio</td>
    <td><?php echo $result['coord']['lon'].'(long) - '.$result['coord']['lat'].'(lat)'?></td>
  </tr>
  <tr>
    <td>Korkein lämpötila</td>
    <td><?php echo round($result['main']['temp_max']-273.15)?>°</td>
  </tr>
  <tr>
    <td>Alin lämpötila</td>
    <td><?php echo round($result['main']['temp_min']-273.15)?>°</td>
  </tr>
  <tr>
    <td>Ilmanpaine</td>
    <td><?php echo $result['main']['pressure']?> hPa</td>
  </tr>
  <tr>
    <td>ilmankosteus</td>
    <td><?php echo $result['main']['humidity']?> %</td>
  </tr>
  <tr>
    <td>Tuulen lämpötila</td>
    <td><?php echo round($result['wind']['deg']-273.15)?>°</td>
  </tr>
  <tr>
    <td>Pilvisyys</td>
    <td><?php echo $result['clouds']['all']?> %</td>
  </tr>
  <tr>
    <td>Systeemi</td>
    <td><?php echo $result['sys']['type']?> 
   </td>
  </tr>
  <tr>
    <td>ID</td>
    <td><?php echo $result['sys']['id']?> </td>
  </tr>
  <tr>
    <td>Maakoodi</td>
    <td><?php echo $result['sys']['country']?> </td>
  </tr>
  <tr>
    <td>Auringon nousu</td>
    <td><?php echo date('H:i', $result['sys']['sunrise']); ?> </td>
  </tr>
  <tr>
    <td>Auringon lasku</td>
    <td><?php echo date('H:i', $result['sys']['sunset']);?> </td>
  </tr>
  <tr>
    <td>Aikajana</td>
    <td><?php echo date('H:i', $result['timezone']); ?> </td>
  </tr>
  <tr>
    <td>Kaupunki ID</td>
    <td><?php echo $result['id'] ?> </td>
  </tr>
</table>
      </article>
      <?php } ?>
   </body>
</html>

