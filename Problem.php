<!--<html>
<head>
<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>
<form method="POST" action = "comp_reg">
Name <input type = "text" name="name"/><br>
Aadhar <input type = "text" name="aadhar"/><br>
Region <input type = "text" name="region"/><br>
District <input type = "text" name="district"/><br>
State <input type = "text" name="state"/><br>
Description <textarea name="desc"></textarea><br>
<input type="submit"/>
</form>
</html>-->

<head>
<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>
<body align="center">
<h1>Register Problem</h1>
<form class="pure-form pure-form-aligned" method = "post" action="comp_reg.php" >
    <fieldset>
        <div class="pure-control-group">
            <label for="name">Name</label>
            <input name= "name" id="name" type="text" placeholder="">
            <!--<span class="pure-form-message-inline">This is a required field.</span>-->
        </div>

        <div class="pure-control-group">
            <label for="Aadhar">Aadhar</label>
            <input name= "aadhar"  type="text" placeholder="">
        </div>

        <div class="pure-control-group">
            <label for="Region">Region</label>
            <input name= "region" id="email" type="text" placeholder="">
        </div>

        <div class="pure-control-group">
            <label for="District">District</label>
            <input name="district" id="foo" type="text" placeholder="">
        </div>

        <div class="pure-control-group">
            <label for="State">State</label>
            <input name= "state" id="foo" type="text" placeholder="">
        </div>

            <button type="submit" class="pure-button pure-button-primary">Submit</button>
        </div>
    </fieldset>
</form>
</body>