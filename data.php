<?php
header("Content-Type: text/javascript");
include_once "skills.php";
?>
function DataSet(name, email, skills, location) {
    this.name = name;
    this.email = email;
    this.skills = skills;
    this.location = location;
}

function Skills(
<?php echo(array_values($js)[0]);
 for($i = 1; $i < count($js);$i++)
 echo(" ,".array_values($js)[$i] ) ?>) {
	<?php foreach($js as $v)
	echo("this.$v = $v;\n")?>
}
var data = [
    new DataSet("Florian Reisinger", "florei+map@libreoffice.org",
    	new Skills(0,0,0,0, 1, 0,0,0,0,0,1,1,0),
    			"Linz, Oesterreich"),
    new DataSet("Max van Muster", "max.muster@example.de",
    	new Skills(0,1,0,0,0,0,1,1,0,0,0,1,0),
    			"Hamburg, Deutschland")
]