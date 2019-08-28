# Tickets4Sale

## Getting Started

To get you started you can simply clone the `tickets4sale` repository and install the dependencies:

### Prerequisites

We also use a number of Node.js tools to initialize and test `tickets4sale`. You must have Node.js
and its package manager (npm) installed. You can get them from [here][node].

### Install Dependencies

```
npm install
```

Behind the scenes this will also call `npm run copy-libs`, which copies the AngularJS files and
other front end dependencies.

* `node_modules` - contains the npm packages for the tools we need
* `app/lib` - contains the AngularJS framework files and other front end dependencies

*Note copying the AngularJS files from `node_modules` to `app/lib` makes it easier to serve the
files by a web server.*

### API Configuration Sample

Each controller decides the `api` url.
Inside `app/home/home.js` you will find a Controller and a Service.
To change the `api` url you just need to update the variable `api` on the Controller.
``` 
...
$scope.dramaShows=[];
  
let api = "/api/shows"; // Here

$scope.getShows = function(){
...
```

### Run the Application

We have preconfigured the project with a simple development web server. The simplest way to start
this server is:

```
npm start
```

Now browse to the app at [`localhost:8000/index.html`][local-app-url].