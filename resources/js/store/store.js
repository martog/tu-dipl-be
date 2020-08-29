import axios from "axios";

axios.defaults.baseURL = "http://localhost:8000/api";

export default {
    state: {
        token: localStorage.getItem("access_token") || null,
        user: JSON.parse(localStorage.getItem("user") || null)
    },
    getters: {
        loggedIn(state) {
            return state.token !== null;
        },
        userData(state) {
            return state.user;
        }
    },
    mutations: {
        retrieveUser(state, user) {
            state.user = user;
        },
        retrieveToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        },
        destroyUser(state) {
            state.user = null;
        }
    },
    actions: {
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/auth/login", {
                        username: credentials.username,
                        password: credentials.password
                    })
                    .then(response => {
                        const token = response.data.access_token;
                        const user = response.data.user;

                        localStorage.setItem("access_token", token);
                        localStorage.setItem("user", JSON.stringify(user));

                        context.commit("retrieveToken", token);
                        context.commit("retrieveUser", user);

                        console.log(response);
                        resolve(response);
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error);
                    });
            });
        }
    }
};
