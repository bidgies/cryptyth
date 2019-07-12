import { USER_ACTIONS } from '../action/user';

const defaultState = {
  authorized: false,
};

export default (state = defaultState, action) => {
  if(action.type === USER_ACTIONS.SET_CURRENT_USER) {
    if(action.payload.user) {
      return {
        authorized: true,
        ...action.payload.user,
      };
    }
  } else if(action.type === USER_ACTIONS.CLEAR_CURRENT_USER) {
    return defaultState;
  }
  return state;
}
