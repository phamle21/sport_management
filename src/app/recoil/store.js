import { atom } from 'recoil';

const accountState = atom({
    key: 'accountState',
    default: {},
});

const tokenState = atom({
    key: 'tokenState',
    default: '',
});

const userListState = atom({
    key: 'userListState',
    default: [],
});

const userListByTypeState = atom({
    key: 'userListByTypeState',
    default: [],
});

const userListType = atom({
    key: 'userListType',
    default: 'All',
});

const statusModelNewUserState = atom({
    key: 'statusModelNewUserState',
    default: false,
})

const statusModelEditUserState = atom({
    key: 'statusModelEditUserState',
    default: false,
})

const modelEdit = atom({
    key: 'modelEdit',
    default: {}
})

const roleState = atom({
    key: 'roleState',
    default: []
})

const selectedUserState = atom({
    key: 'selectedUserState',
    default: []
})

const seasonListState = atom({
    key: 'seasonListState',
    default: []
})

const selectedSeasonState = atom({
    key: 'selectedSeasonState',
    default: []
})

const UserEditState = atom({
    key: 'UserEditState',
    default: []
})
export {
    UserEditState,
    selectedSeasonState,
    seasonListState,
    selectedUserState,
    roleState,
    modelEdit,
    statusModelEditUserState,
    accountState,
    tokenState,
    userListByTypeState,
    userListState,
    userListType,
    statusModelNewUserState,
}