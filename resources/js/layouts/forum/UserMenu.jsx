import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';

import { dispatchUserLogout } from '../../action/user';
import authService from '../../services/auth';

class UserMenu extends Component {
  constructor(props) {
    super(props);

    this.logout = this.logout.bind(this);
  }

  logout() {
    authService.logout().then(() => {
      this.props.logout();
    });
  }
    render() {
        return (
            <nav className="user-nav">
              {!this.props.user.authorized ? (
                <React.Fragment>
                  <Link to="/login">
                    Login
                  </Link>
                  <Link to="/register">
                    Register
                  </Link>
                </React.Fragment>
              ) : (
                <React.Fragment>
                  <Link>
                    {this.props.user.name}
                  </Link>
                  <Link onClick={this.logout}>
                    Logout
                  </Link>
                </React.Fragment>
              )}
            </nav>
        );
    }
}

export default connect((state) => ({
  user: state.user
}), {
  logout: dispatchUserLogout,
})(UserMenu);
