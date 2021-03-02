const socketEvent = (evt, obj) => {
    if ((typeof (socket) != "undefined")) {
        if (obj === undefined) {
            socket.emit(evt);
        } else {
            socket.emit(evt, obj);
        }
    }
};

export default socketEvent;