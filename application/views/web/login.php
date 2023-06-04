<!--<br><br>
<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading"><h3>Student Login</h3></div>
		<div class="panel-body">

	<form id="login_web" >
					
        			<div class="form-group col-xs-12 col-md-12 col-lg-4">
        				<label>Email ID</label>
        				<input type="email" class="form-control" name="user_id" placeholder="Enter Email" required="required">
        			</div>
        			<div class="form-group col-xs-12 col-md-12 col-lg-4">
        				<label>Address</label>
        				<input type="text" class="form-control" name="address" required="required">
        			</div>
        			<div class="form-group col-xs-12 col-md-12 col-lg-4">
        				<label>Password</label>
        				<input type="password" class="form-control" name="password" required="required">
        			</div>
        			<div class="form-group col-xs-12 col-md-12 col-lg-4">
        				<label>Confirm Password</label>
        				<input type="paasword" class="form-control" name="password" required="required">
        			</div>
        			
        			
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<button class="btn btn-info col-lg-12 col-xs-12 col-sm-12" type="submit" >Submit</button>
				</div>
			</form>
		</div>
	</div>
	<br>
	<br>-->
	<style>
	    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}
.div_center{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #131419;
}
.form{
    position: relative;
    width: 350px;
    padding: 40px 40px 60px;
    background: #131419;
    border-radius: 10px;
    text-align: center;
    box-shadow: -5px -5px 10px rgba(255,255,255,0.05),
                5px 5px 10px rgba(0,0,0,0.5);
}
.form h2{
    color: #c7c7c7;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 4px;
}
.form .input{
    text-align: left;
    margin-top: 40px;
}
.form .input .inputBox{
    margin-top: 20px;
}
.form .input .inputBox label{
    display: block;
    color: #868686;
    margin-bottom: 5px;
    font-size: 18px;
}
.form .input .inputBox input{
    width: 100%;
    height: 50px;
    background: #131419;
    outline: none;
    border: none;
    border-radius: 40px;
    padding: 5px 15px;
    color: #fff;
    font-size: 18px;
    color: #03a9f4;
    box-shadow: inset -2px -2px 6px rgba(255,255,255,0.1),
    inset 2px 2px 6px rgba(0,0,0,0.8);
}
.form .input .inputBox input[type="submit"]{
    margin-top: 20px;
    box-shadow: -2px -2px 6px rgba(255,255,255,0.1),
                2px 2px 6px rgba(0,0,0,0.8);
}
.form .input .inputBox .input[type="submit"]:active{
    color: #006c9c;
    margin-top: 20px;
    box-shadow: inset -10px -2px 6px rgba(255,255,255,0.1),
                inset 10px 2px 6px rgba(0,0,0,0.8);
}
.form .input .inputBox input::placeholder{
    color: #555;
    font-size: 18px;
}
.forget{
    margin-top: 30px;
    color: #555;
}
.forget a{
    color: #ff0047;
}
	</style>
	<div class="div_center">
        <div class="form">
            <h2>Login</h2>
            <form action="/" method="post">
                <div class="input">
                    <div class="inputBox">
                        <label for="">Username</label>
                        <input type="text" name="username" id="" placeholder="Username">
                    </div>
                    <div class="inputBox">
                        <label for="">Password</label>
                        <input type="password" name="password" id="Username" placeholder="********">
                    </div>
                    <div class="inputBox">
                        <input type="submit" id="" value="Sign In">
                    </div>
                </div>
            </form>
            <p class="forget">Forget Password ? <a href="">Click Here</a></p>
        </div>
    </div>