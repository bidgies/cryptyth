import React, { Component } from 'react';
import { Route, Switch, BrowserRouter as Router } from 'react-router-dom';
import { connect } from 'react-redux';

import NationalNews from './NationalNews';
import RegionalNews from './RegionalNews';
import ForumIndex from './forum/Index';
import Sightings from './Sightings';
import Login from './auth/Login';

import { dispatchCurrentUser } from '../action/user';
import authService from '../services/auth';

class RouteSwitch extends Component {
    constructor(props) {
      super(props);

      if(!props.user.authenticated) {
        authService.getCurrentUser().then((user) => {
          props.loginUser(user);
        });
      }
    }

    render() {
        return (
          <Router>
            <Switch>
              <Route exact path="/" component={NationalNews} />
              <Route path="/regional" component={RegionalNews} />
              <Route path="/forum" component={ForumIndex} />
              <Route path="/sightings" component={Sightings} />
              <Route path="/login" component={Login} />
            </Switch>
          </Router>
        );
    }
}

export default connect((state) => ({
  user: state.user
}), {
  loginUser: dispatchCurrentUser,
})(RouteSwitch);
