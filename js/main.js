window.utils = {
    getToast: function (msg) {
        this.waitForM(function () {
            M.toast({
                html: msg
            });
        });
    },
    waitForM: function (callback) {
        var time = 0;
        var timer = setInterval(function () {
            if (window.M) {
                clearInterval(timer);
                callback();
            } else {
                if (time > 500) {
                    clearInterval(timer);
                    console.warn("M object wait TIMEOUT");
                } else time++;
            }
        }, 100)
    }
}