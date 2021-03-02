import ColorThief from '../helpers/colorThief';

const getDominantColor = (element) => {
    var exists = ($(element).length > 0) ? true : false;
    var color = [];
    if (exists) {
        var colorThief = new ColorThief();
        color = colorThief.getColor(element[0]);
    }
    return color;
};

export default getDominantColor;