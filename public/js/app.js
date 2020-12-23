/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, exports) {

eval("throw new Error(\"Module build failed (from ./node_modules/babel-loader/lib/index.js):\\nSyntaxError: D:\\\\dad\\\\ProjetoDAD\\\\resources\\\\js\\\\app.js: Unexpected token, expected \\\",\\\" (44:4)\\n\\n\\u001b[0m \\u001b[90m 42 | \\u001b[39m    { path\\u001b[33m:\\u001b[39m \\u001b[32m\\\"/users/newAccount\\\"\\u001b[39m\\u001b[33m,\\u001b[39m component\\u001b[33m:\\u001b[39m \\u001b[33mUserRegister\\u001b[39m\\u001b[33m,\\u001b[39m name\\u001b[33m:\\u001b[39m \\u001b[32m\\\"usersRegister\\\"\\u001b[39m}\\u001b[0m\\n\\u001b[0m \\u001b[90m 43 | \\u001b[39m    \\u001b[90m//{ path: \\\"/logout\\\", component: LogoutComponent},\\u001b[39m\\u001b[0m\\n\\u001b[0m\\u001b[31m\\u001b[1m>\\u001b[22m\\u001b[39m\\u001b[90m 44 | \\u001b[39m    { path\\u001b[33m:\\u001b[39m \\u001b[32m\\\"/products\\\"\\u001b[39m\\u001b[33m,\\u001b[39m component\\u001b[33m:\\u001b[39m \\u001b[33mProduct\\u001b[39m}\\u001b[33m,\\u001b[39m\\u001b[0m\\n\\u001b[0m \\u001b[90m    | \\u001b[39m    \\u001b[31m\\u001b[1m^\\u001b[22m\\u001b[39m\\u001b[0m\\n\\u001b[0m \\u001b[90m 45 | \\u001b[39m    { path\\u001b[33m:\\u001b[39m \\u001b[32m\\\"/userProfile\\\"\\u001b[39m\\u001b[33m,\\u001b[39m component\\u001b[33m:\\u001b[39m \\u001b[33mUserProfile\\u001b[39m}\\u001b[33m,\\u001b[39m\\u001b[0m\\n\\u001b[0m \\u001b[90m 46 | \\u001b[39m    { path\\u001b[33m:\\u001b[39m \\u001b[32m\\\"/users/newAccount\\\"\\u001b[39m\\u001b[33m,\\u001b[39m component\\u001b[33m:\\u001b[39m \\u001b[33mUserRegister\\u001b[39m}\\u001b[33m,\\u001b[39m\\u001b[0m\\n\\u001b[0m \\u001b[90m 47 | \\u001b[39m    { path\\u001b[33m:\\u001b[39m \\u001b[32m\\\"/cookDashboard\\\"\\u001b[39m\\u001b[33m,\\u001b[39m component\\u001b[33m:\\u001b[39m cookDashboard}\\u001b[33m,\\u001b[39m\\u001b[0m\\n    at Parser._raise (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:790:17)\\n    at Parser.raiseWithData (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:783:17)\\n    at Parser.raise (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:777:17)\\n    at Parser.unexpected (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:9095:16)\\n    at Parser.expect (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:9081:28)\\n    at Parser.parseExprList (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:11229:14)\\n    at Parser.parseArrayLike (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:11133:26)\\n    at Parser.parseExprAtom (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:10434:23)\\n    at Parser.parseExprSubscripts (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:10094:23)\\n    at Parser.parseUpdate (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:10074:21)\\n    at Parser.parseMaybeUnary (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:10063:17)\\n    at Parser.parseExprOps (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:9933:23)\\n    at Parser.parseMaybeConditional (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:9907:23)\\n    at Parser.parseMaybeAssign (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:9870:21)\\n    at D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:9837:39\\n    at Parser.allowInAnd (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:11504:16)\\n    at Parser.parseMaybeAssignAllowIn (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:9837:17)\\n    at Parser.parseVar (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:12305:70)\\n    at Parser.parseVarStatement (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:12114:10)\\n    at Parser.parseStatementContent (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:11706:21)\\n    at Parser.parseStatement (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:11639:17)\\n    at Parser.parseBlockOrModuleBlockBody (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:12221:25)\\n    at Parser.parseBlockBody (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:12207:10)\\n    at Parser.parseTopLevel (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:11570:10)\\n    at Parser.parse (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:13381:10)\\n    at parse (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\parser\\\\lib\\\\index.js:13434:38)\\n    at parser (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\core\\\\lib\\\\parser\\\\index.js:54:34)\\n    at parser.next (<anonymous>)\\n    at normalizeFile (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\core\\\\lib\\\\transformation\\\\normalize-file.js:99:38)\\n    at normalizeFile.next (<anonymous>)\\n    at run (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\core\\\\lib\\\\transformation\\\\index.js:31:50)\\n    at run.next (<anonymous>)\\n    at Function.transform (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\@babel\\\\core\\\\lib\\\\transform.js:27:41)\\n    at transform.next (<anonymous>)\\n    at step (D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\gensync\\\\index.js:261:32)\\n    at D:\\\\dad\\\\ProjetoDAD\\\\node_modules\\\\gensync\\\\index.js:273:13\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9hcHAuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc2Fzcy9hcHAuc2Nzcz8wZTE1Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL3Nhc3MvYXBwLnNjc3MuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/sass/app.scss\n");

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\dad\ProjetoDAD\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! D:\dad\ProjetoDAD\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });