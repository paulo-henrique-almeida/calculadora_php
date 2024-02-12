<!DOCTYPE html>
<html lang="pt-br">
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      background-color: #121212;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .calculator {
      background-color: #202020;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 10px 10px 10px rgba(0, 0, 0, .323);
      text-align: center;
      max-width: 300px;
      font-size: 2em;
    }

    #display {
      width: 90%;
      padding: 10px;
      font-size: 40px;
      text-align: right;
      border-radius: 5px;
      margin-bottom: 10px;
      background-color: #323232;
      border: none;
      color: #ffffff;
    }

    #display:focus-visible {
      outline: none;
    }

    .buttons {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 5px;
    }

    button {
      font-size: 24px;
      padding: 15px;
      background-color: #3B3B3B;
      color: #ffffff;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      transition: all .3s ease;
    }

    button:hover {
      background-color: #323232;
    }

    button[name="operator"],
    button[name="decimal"],
    button[name="clear"] {
      background-color: #323232;
    }

    button[name="operator"]:hover,
    button[name="decimal"]:hover,
    button[name="clear"]:hover {
      background-color: #3B3B3B;
    }

    button[name="calculate"] {
      background-color: #005A9E;
    }

    button[name="calculate"]:hover {
      background-color: #0876CA;
    }
  </style>
</head>

<body>

  <div class="calculator">
    <form method="post">
      <input type="text" name="calculation" id="display" value="<?php echo isset($_POST['calculation']) ? $_POST['calculation'] : ''; ?>" readonly>

      <div class="buttons">
        <button type="submit" name="clear" value="C">C</button>
        <button type="submit" name="decimal" value=".">.</button>
        <button type="submit" name="operator" value="/">÷</button>
        <button type="submit" name="operator" value="*">×</button>
        <button type="submit" name="digit" value="7">7</button>
        <button type="submit" name="digit" value="8">8</button>
        <button type="submit" name="digit" value="9">9</button>
        <button type="submit" name="operator" value="-">-</button>
        <button type="submit" name="digit" value="4">4</button>
        <button type="submit" name="digit" value="5">5</button>
        <button type="submit" name="digit" value="6">6</button>
        <button type="submit" name="operator" value="+">+</button>
        <button type="submit" name="digit" value="1">1</button>
        <button type="submit" name="digit" value="2">2</button>
        <button type="submit" name="digit" value="3">3</button>
        <button type="submit" name="calculate" value="=">=</button>
        <button type="submit" name="digit" value="0">0</button>
      </div>
    </form>

    <?php

    if (isset($_POST['calculate'])) {
      $calculation = $_POST['calculation'];
      $calculation = preg_replace('/[^0-9+\-.*\/()%]/', '', $calculation);

      if (eval('return ' . $calculation . ';') === false) {
        echo '<p class="result">Erro</p>';
      } else {
        $result = eval('return ' . $calculation . ';');
        echo '<p class="result">Resultado: ' . $result . '</p>';
      }
    }

    ?>

  </div>

  <script>
    let display = document.getElementById('display');
    let calculation = "";

    function appendToDisplay(value) {
      calculation += value;
      display.value = calculation;
    }

    function clearDisplay() {
      calculation = "";
      display.value = calculation;
    }

    document.querySelector('.buttons').addEventListener('click', function(event) {
      event.preventDefault();
      if (event.target.tagName === 'BUTTON') {
        if (event.target.name === 'clear') {
          clearDisplay();
        } else if (event.target.name === 'calculate') {
          calculate();
        } else {
          appendToDisplay(event.target.value);
        }
      }
    });

    function calculate() {
      try {
        calculation = eval(calculation).toString();
        display.value = calculation;
      } catch (error) {
        display.value = "Erro";
      }
    }
  </script>

</body>

</html>