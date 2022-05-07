
<!DOCTYPE html>
<html>

<head>
        <title>Payment Gateway</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
        
        <link rel="stylesheet" type="text/css" href="Style.css">

        <style type="text/css">
        .error {
            font-size: 15px;
            color: red;
        }
        </style>
</head>

<body>

    <?php

    $CardNumberErr = $M_YErr = $CVVErr = $NameonCardErr = NULL;
    $CardNumber = $M_Y = $CVV = $NameonCard = NULL;

    $flag = true;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["CardNumber"]))
        {
            $CardNumberErr = "Card number is required";
            $flag = false;
        } else {
            $CardNumber = test_input($_POST["CardNumber"]);
        }

        if (empty($_POST["M_Y"]))
        {
            $M_YErr = "Exp date is required";
            $flag = false;
        } else {
            $M_Y = test_input($_POST["M_Y"]);
        }

        if (empty($_POST["CVV"]))
        {
            $CVVErr = "CVV number is required";
            $flag = false;
        } else {
            $CVV = test_input($_POST["CVV"]);
        }

        if (empty($_POST["NameonCard"]))
        {
            $NameonCardErr = "Card holder name is required";
            $flag = false;
        } else {
            $NameonCard = test_input($_POST["NameonCard"]);
        }

        // submit form if validated successfully

        if($flag)
        {
            $conn = new mysqli("localhost", "root", "", "payment");
            
            if ($conn->connect_error)
            {
                die("Error: Connection Failed " . $conn->connect_error);
            }

            $sql = "INSERT INTO card_details (Card_holder_name,Card_Number,CVV_Code,Exp_Dt) VALUES('$NameonCard', '$CardNumber', '$CVV', '$M_Y') ";

            if($conn->query($sql) === TRUE)
            {
                echo "<script> alert('Payment Done And Card Details Saved') </script>";
            }
        }

    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;    
    }

    ?>

    <form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="container">
        <div class="row">
            
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Payment Methods</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p> <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample"> <span class="fw-bold">Pay With Debit or Credit Card</span> <span class=""> <span class="fab fa-cc-amex"></span> <span class="fab fa-cc-mastercard"></span> <span class="fab fa-cc-discover"></span> </span> </a> </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample">
                            <div class="row">
                                <div class="col-lg-5 mb-lg-0 mb-3">
                                    <p class="h4 mb-0">Summary</p>
                                    <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: iPhone 13 Pro Max</span> </p>
                                    <p class="mb-0"> <span class="fw-bold">Price:</span> <span class="c-green">:$1199.90</span> </p>
                                    <p class="mb-0"><br><b>Specifications:</b><br><b>Display:</b> Super Retina XDR OLED, 120Hz, HDR10, Dolby Vision, 1000 nits (HBM), 1200 nits (peak)<br><b> Chipset:</b> Apple A15 Bionic (5 nm)<br> <b> Internal:</b> 1TB 6GB RAM <br> <b>Camera:</b> Triple Camera 12 MP each<br> <b>Battery:</b> Li-Ion 4352 mAh, non-removable (16.75 Wh)<br></p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="" class="form">
                                        <div class="row">
                                            <form action="" method="POST">
                                             <div class="col-12">
                                                <div class="form__div">
                                                     
                                                    <input type="number" name="CardNumber" onKeyPress="if(this.value.length==16) return false;" class="form-control" placeholder=" " value="<?= $CardNumber; ?>"> <label for="" class="form__label">Card Number</label>
                                                    <span class="error"> <?= $CardNumberErr; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form__div">
                                                     
                                                    <input type="month" name="M_Y" class="form-control" placeholder=" " value="<?= $M_Y; ?>"> <label for="" class="form__label">Month / Year</label>
                                                    <span class="error"> <?= $M_YErr; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form__div">
                                                     
                                                    <input type="password"  type="number" onKeyPress="if(this.value.length==3) return false;" name="CVV" class="form-control" placeholder=" " value="<?= $CVV; ?>"> <label for="" class="form__label">CVV code</label>
                                                    <span class="error"> <?= $CVVErr; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                     
                                                    <input type="text" name="NameonCard" class="form-control" placeholder=" " value="<?= $NameonCard; ?>"> <label for="" class="form__label">Name on the card</label>
                                                  <span class="error"> <?= $NameonCardErr; ?></span>  
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                
                                                <input class="btn btn-info w-100" type="submit" name="button"></div>
                                                
                                            </div>
                                            </form>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
