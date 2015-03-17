

// Retrieve
var MongoClient = require('mongodb').MongoClient;

// Connect to the db
MongoClient.connect("mongodb://localhost:27017/cal", function(err, db) {
  if(!err) {
    alert("mongodb connected!");
  }
});


document.write("{\"name\": \"forman\"}");