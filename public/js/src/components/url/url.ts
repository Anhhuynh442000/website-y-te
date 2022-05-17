const PUBLIC_PREFIX = '/public';

export const createUrl = (path: string, params = {}) => {
    const pathRequest = window.location.pathname;
    const index = pathRequest.indexOf(PUBLIC_PREFIX);
    let pathPublic = '';
    if (index !== -1) {
        pathPublic = pathRequest.substring(0, index + PUBLIC_PREFIX.length);
    } else {
        pathPublic = '';
    }
    pathPublic += `/${path}`;
    const protocol = window.location.protocol;
    const host = window.location.host;
    if (!isEmpty(params)) {
        let linkParams = '';
        for (const [key, value] of Object.entries(params)) {
            linkParams += `${key}=${value}&`;
        }
        pathPublic += `?${linkParams.substring(0, linkParams.length - 1)}`;
    }

    return `${protocol}//${host}${pathPublic}`;
};

const isEmpty = (obj: object) => {
    for (const i in obj) return false;
    return true;
};
