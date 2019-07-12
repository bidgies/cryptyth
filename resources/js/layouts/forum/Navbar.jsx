import React, { Component } from 'react';
import { Link } from 'react-router-dom';

export default class Navbar extends Component {
    render() {
        return (
            <nav className="main-nav">
              <Link className="nav-link active" to="/">
                National Updates
              </Link>
              <Link className="nav-link" to="/regional">
                Regional Updates
              </Link>
              <Link className="nav-link" to="/forum">
                Forums
              </Link>
              <Link className="nav-link" to="/sightings">
                Your Sightings
              </Link>
            </nav>
        );
    }
}
