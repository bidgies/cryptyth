export const USER_ACTIONS = {
  SET_CURRENT_USER: 'SET_CURRENT_USER',
  CLEAR_CURRENT_USER: 'CLEAR_CURRENT_USER',
};

export const dispatchCurrentUser = (user) => ({
  type: USER_ACTIONS.SET_CURRENT_USER,
  payload: { user },
});

export const dispatchUserLogout = (user) => ({
  type: USER_ACTIONS.CLEAR_CURRENT_USER,
  payload: null,
});
