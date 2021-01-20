var express = require('express');
var app = express();
var sphp = require('sphp');
app.use(sphp.express('/home/ec2-user/mojobox-website/public/'));
app.use(express.static('/home/ec2-user/mojobox-website/public/')); //Serves resources from public folder
var server = app.listen(8089);
console.log('website is listing @ 8089')

app.get('/', function(req, res) {
    // Prepare the context
    res.redirect('/index.php');
    
});
app.get('/wp-admin', function(req, res) {
    // Prepare the context
    res.redirect('/wp-admin/admin.php');

});

