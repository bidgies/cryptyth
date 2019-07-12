import React, { Component } from 'react';

import Header from './Header';
import Navbar from './Navbar';
import UserMenu from './UserMenu';
import Footer from './Footer';
import Ads from './Ads';

export default class ForumLayout extends Component {
    render() {
        return (
            <div className="main-wrapper">
              <Header />
              <div className="sidebar">
                <Navbar />
                <Ads />
              </div>

              <div className="main">
                <UserMenu />
                <div className="content">
                  {this.props.children}
                </div>
              </div>

              <Footer />
            </div>
        );
    }
}
