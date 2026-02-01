import './bootstrap';

// API base URL for Axios (Sanctum CRUD)
window.APP_API_BASE = (window.APP_URL || '') + '/api';

// Set Axios default base URL and auth when token is available
export function setApiToken(token) {
    if (token && window.axios) {
        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }
}
window.setApiToken = setApiToken;
