"use strict";

var obj = {
    method: function method() {
        var _this = this;

        return function () {
            return _this;
        };
    }
};
// Due to lexical scope obj.method()() <===> obj

var fact = function (n) {
    return n === 0 ? 1 : n * fact(n - 1);
};

var fib = function (n) {
    return n < 2 ? n : fib(n - 1) + fib(n - 2);
};
console.log(obj.method() instanceof Function);
