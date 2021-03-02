export const isJson = (data) => {
    let res = [];
    try {
        const info = JSON.parse(data);
        res[0] = true;
        res[1] = info;
    } catch (err) {
        res[0] = false;
        res[1] = "";
    }
    return res;
};