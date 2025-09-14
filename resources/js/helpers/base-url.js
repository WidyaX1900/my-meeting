const baseUrl = (path = '') => {
    const protocol = window.location.protocol;
    const hostname = window.location.hostname;
    const port = window.location.port;

    const url = `${protocol}//${hostname}`;
    
    if(url === 'https://meeting.widyaweb.com') {
        return `https://meeting.widyaweb.com/${path}`;
    }

    return `${url}:${port}/${path}`;
}

export { baseUrl };