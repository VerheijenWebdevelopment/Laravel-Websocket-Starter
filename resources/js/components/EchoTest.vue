<template>
    <div id="echo-test">
        <div id="echo-test__left">

            <h2>Chatbox</h2>
            
            <div id="echo-test__chat">
                <div id="echo-test__messages" v-if="messages.length > 0">
                    <div class="echo-test__message" v-for="(message, mi) in messages" :key="mi">
                        <div class="echo-test__message-user">
                            {{ message.user.name }}
                        </div>
                        <div class="echo-test__message-text">
                            {{ message.message }}
                        </div>
                    </div>
                </div>
                <div id="echo-test__no-messages" v-if="messages.length === 0">
                    No messages received yet
                </div>
            </div>

            <div id="echo-test__form">
                <div id="echo-test__form-input">
                    <input type="text" v-model="form.message" @keydown.enter.prevent="onClickSubmit">
                </div>
                <div id="echo-test__form-submit">
                    <button @click="onClickSubmit" :disabled="submitDisabled">
                        Send message
                    </button>
                </div>
            </div>

        </div>
        <div id="echo-test__right">
            
            <h2>Online users</h2>
            
            <ul id="echo-test__users" v-if="users.length > 0">
                <li class="echo-test__user" v-for="(user, ui) in users" :key="ui">
                    {{ user.name }}
                </li>
            </ul>
            
            <div id="echo-test__no-users" v-if="users.length === 0">
                No online users
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "user",
            "apiEndpoint",
        ],
        data: () => ({
            tag: "[echo-test]",
            connected: false,
            users: [],
            messages: [],
            form: {
                message: "",
            }
        }),
        computed: {
            submitDisabled() {
                return this.form.messages === "";
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" api endpoint: ", this.apiEndpoint);
                this.startListening();
            },
            startListening() {
                Echo.join('Test')
                    .here(this.onConnected)
                    .joining(this.onJoining)
                    .leaving(this.onLeaving)
                    .listen('TestEvent', this.onTestEvent);
            },
            onConnected(users) {
                console.log(this.tag+" connected to channel", users);
                this.connected = true;
                this.users = users;
            },
            onJoining(user) {
                console.log(this.tag+" user joining channel", user);
                this.users.push(user);
            },
            onLeaving(user) {
                console.log(this.tag+" user left channel", user);
                for (let i = 0; i < this.users.length; i++) {
                    if (this.users[i].id === user.id) {
                        this.users.splice(i, 1);
                        break;
                    }
                }
            },
            onTestEvent(e) {
                console.log(this.tag+" received 'TestEvent'", e);
                this.messages.push({
                    user: e.user,
                    message: e.message,
                });
            },
            onClickSubmit() {
                console.log(this.tag+" clicked submit button");
                
                let message = this.form.message;
                this.form.message = "";

                let payload = new FormData();
                payload.append("message", message);

                this.axios.post(this.apiEndpoint, payload)
                    .then(function(response) {
                        console.log(this.tag+" api request succeeded");
                        if (response.data.status === "success") {
                            console.log(this.tag+" succesfully sent message");
                            this.messages.push({
                                user: this.user,
                                message: message,
                            });
                        } else {
                            console.log(this.tag+" failed to send message");
                        }
                    }.bind(this))
                    .catch(function(error) {
                        console.log(this.tag+" api request failed");
                    }.bind(this));

            }
        },
        mounted() {
            this.initialize();
        },
    }
</script>

<style lang="scss">
    #echo-test {
        width: 1000px;
        display: flex;
        flex-direction: row;
        #echo-test__left {
            flex: 1;
            margin: 0 30px 0 0;
            #echo-test__chat {
                margin: 0 0 30px 0;
                #echo-test__messages {
                    border-radius: 3px;
                    border: 1px solid rgba(0, 0, 0, 0.1);
                    .echo-test__message {
                        display: flex;
                        padding: 10px 15px;
                        flex-direction: row;
                        box-sizing: border-box;
                        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                        &:last-child {
                            border-bottom: 0;
                        }
                        .echo-test__message-user {
                            font-weight: 600;
                            margin: 0 10px 0 0;
                        }
                        .echo-test__message-text {

                        }
                    }
                }
                #echo-test__no-messages {
                    border-radius: 3px;
                    padding: 10px 15px;
                    box-sizing: border-box;
                    border: 1px solid rgba(0, 0, 0, 0.1);
                }
            }
            #echo-test__form {
                display: flex;
                flex-direction: row;
                #echo-test__form-input {
                    flex: 1;
                    input[type=text] {
                        width: 100%;
                        height: 35px;
                        padding: 0 10px;
                        line-height: 35px;
                        box-sizing: border-box;
                        border: 1px solid rgba(0, 0, 0, 0.1);
                    }
                }
                #echo-test__form-submit {
                    margin: 0 0 0 15px;
                    button {
                        border: 0;
                        height: 35px;
                        padding: 0 15px;
                        border-radius: 3px;
                        transition: all .3s;
                        border: 1px solid rgba(0, 0, 0, 0.1);
                        &:hover {
                            cursor: pointer;
                            background-color: hsl(0, 0%, 98%);
                        }
                    }
                }
            }
        }
        #echo-test__right {
            flex: 0 0 300px;
            #echo-test__users {
                margin: 0;
                padding: 0;
                list-style: none;
                border-radius: 3px;
                border: 1px solid rgba(0, 0, 0, 0.1);
                .echo-test__user {
                    padding: 10px 15px;
                    box-sizing: border-box;
                    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                    &:last-child {
                        border-bottom: 0;
                    }
                }
            }
        }
    }
</style>