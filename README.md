# Inecol Project

The instructions to set up the project are described below:

## Install the following tools:
* PHP (version 5.5 or greater) and enable Mod_Rewrite.
* MySQL (version 5.7 or greater)
* Node.js and NPM (version 10 or greater)

### The Back end
The back-end side runs in PHP and Node.js. The whole logic of the project is managed by PHP. In addition, Node.js is used in order to handle real-time data.
This project could run without a Node.js server. If there is no Node.js instance, the project will work normally and will ignore the real-time functionality.
The entire logic of the back end is stored in the folder `./app`. In this folder the files are structured as follows:
* /models: manages the data, logic, and rules of the application.
* /views: presents the model’s data to the user.
* /controllers: accepts input and converts it to commands for the model or view.
* /builders: defines user layouts based on the inputs.
* /configuration: defines the configuration of the application.
* /helpers: functions that are shared across the project.
* /server: Node.js server logic.

### The Front end
The logic of the font-end side is presented in the folder: `./client`. The files are structured as follows:
* /build: will contain the whole source code of the application once is transpiled
* /src: the logic of the application
* package.json: defines the modules required by the application
* webpack.config: the configuration of webpack

You need to transpile the code before running the application. You can transpile the code using the webpack `webpack --watch` when you are located in the folder `./client`

### Public folder
Contains all the assets that the project requires, such as, images, CSS styles, libraries, and so on.

## Notes:

* The root file is `./index.php` (is located in the root folder)
* The default url is `http://localhost:8080/`
* You can change the configuration of the urls in `./app/configuration/global.php` for the back-end side and `./client/src/constants/urls.js` for the front-end side.
* You can modify the database configuration in the file `./app/configuration/conexion.php`
