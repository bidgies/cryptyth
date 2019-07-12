import React, { Component } from 'react';

export default class Footer extends Component {
    render() {
        return (
            <footer className="footer">
              <div className="links">
                Rules &middot; TOS &middot; About Us
              </div>
              <div className="credit">
                Powered by CryptiForums
              </div>
            </footer>
        );
    }
}
