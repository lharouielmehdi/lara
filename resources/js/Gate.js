export default class Gate {
    constructor(user) {
        this.user = user;
    }
    isAdmin() {
        return this.user.type === "admin";
    }
    isTest() {
        return this.user.type === "test";
    }
}
