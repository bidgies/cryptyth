import React, { Component } from 'react';
import axios from 'axios';
import { connect } from 'react-redux';

import ForumLayout from '../../layouts/forum/Layout';

import { dispatchCurrentUser } from '../../action/user';
import authService from '../../services/auth';

class Login extends Component {

  constructor(props) {
    super(props);

    this.state = {
      login: '',
      password: '',
    }

    this.login = this.login.bind(this);
  }

  login() {
    authService.login(this.state.login, this.state.password).then((user) => {
      this.props.loginUser(user);
      this.props.history.push('/');
    })
  }

  handleField(fieldName) {
    return (event) => {
      this.setState({ [fieldName]: event.target.value});
    }
  }

  render() {
    return (
      <ForumLayout>
      <h1>Login</h1>
      <fieldset>
      <label>Username/Email</label>
      <input type="text" name="login" value={this.state.login} onChange={this.handleField('login')}/>
      <label>Password</label>
      <input type="password" name="password" value={this.state.password} onChange={this.handleField('password')}/>
      </fieldset>
      <button onClick={this.login}>Login</button>
      </ForumLayout>
    );
  }
}

export default connect(null, {
  loginUser: dispatchCurrentUser,
})(Login);
