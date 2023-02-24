<?php

if (isset($_POST['submit'])) {

  $amount = $_POST['price'];
}
?>

<html lang='eng'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href="style.css">
  <title> PAYMENT</title>
</head>

<body>
  <form action="./stk.php" method="POST">
    <h2>Payment method</h2>
    <label> product price</label>
    <input type="text" name="total" id="prize" value="<?php echo $amount ?>" onblur="multiply()"><br><br><br>
    <lable>Quantity</lable>
    <input type="number" name="quantity" id="quantity" onblur="multiply()"> <br><br>

    <label>Total price</label>
    <input type="text" name="amount" id="total"><br><br>
    <br>
    <label for="phone"> Enter phone number</label>
    <input type="tel" id="phone" name="phone"><br><br>


    <button type="submit" name="submit"> submit</button>

    <p class="error"><?php echo @$error ?></p>
    <p class="success"><?php echo @$success  ?></p>
  </form>

  <script>
    function multiply() {
      var price = document.getElementById("prize").value;
      var quantity = document.getElementById("quantity").value;
      var total = parseFloat(price) * parseFloat(quantity);
      console.log(total);
      document.getElementById("total").value = total;

      console.log("hello");
    }
  </script>


</body>

</html>

<?php ?>