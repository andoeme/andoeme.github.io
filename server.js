const express = require('express');
const hbs = require('hbs');
const path = require('path');

let app = express();
let instance = hbs.create();

hbs.registerPartials(path.join(__dirname, 'views', 'partials'));
// hbs.registerPartials(__dirname + '\\views\\partials');
// hbs.registerPartial('header', __dirname + '/views/partials/header.hbs');
//hbs.registerPartial('footer', '<footer><p>{{currentYear}}</p></footer>');
console.log(path.join(__dirname, 'views', 'partials'));

app.engine('hbs', instance.__express);
app.set('view engine', 'hbs');
app.use(express.static(__dirname));

app.get('/', (req, res) => {
    res.send({
        name: "Melanie",
        likes: [
            "Berries",
            "Chocolate"
        ]
    });
})

app.get('/home', (req, res) => {
    res.render('home.hbs', {
        name: "Melanie",
        likes: [
            "Berries",
            "Chocolate"
        ],
        welcomeMessage: 'Hi there!',
        pageTitle: 'My Website',
        currentYear: new Date().getFullYear()
    });
})

app.get('/about', (req, res) => {
    //res.send('About Page');
    res.render('about.hbs', {
        pageTitle: 'Current Year:',
        currentYear: new Date().getFullYear()
    });
})

app.get('/bad', (req, res) => {
    res.send({
        errorMessage: 'Unable to handle request'
    });
})

app.listen(3000);