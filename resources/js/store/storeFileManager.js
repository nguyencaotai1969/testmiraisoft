import router from '../../js/app.js';

export default {

    state: {
        listFolders:
        [
		  {
		    "id": 1,
		    "name": "Uploads",
		    "children": [
		      {
		        "id": 10,
		        "name": "Images",
		        "children": [
		          {
		            "id": 101,
		            "name": "Seasandiego.jpg",
		            "url": "https://assets.site-static.com/userFiles/2597/image/2023/CARDIFF_BY_THE_SEA/5-23-2023_1__reasons-why-cardiff-by-the-sea-san-diego-great-place-to-live/9_Reasons_Why_Cardiff-by-the-Sea_San_Diego_.jpg",
		            "type": "image/jpg",
		            "dimmension": "2000x2000",
		            "size": "763300",
		            "photo_by": "Admin"
		          },
		          {
		            "id": 102,
		            "name": "iMactwin.png",
		            "url": "https://i.insider.com/60e4cb0d22d19400191c957c?width=1000&format=jpeg&auto=webp",
		            "type": "image/png",
		            "dimmension": "2000x2000",
		            "size": "640200",
		            "photo_by": "Apple"
		          },
		          {
		            "id": 103,
		            "name": "hustlecup.jpg",
		            "url": "https://images.deliveryhero.io/image/fd-ph/LH/kmph-hero.jpg",
		            "type": "image/jpg",
		            "dimmension": "2000x2000",
		            "size": "100400",
		            "photo_by": "Admin"
		          },
		          {
		            "id": 104,
		            "name": "MS-Surface.jpg",
		            "url": "https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE4OXzi?ver=3a58",
		            "type": "image/jpg",
		            "dimmension": "2000x2000",
		            "size": "113200",
		            "photo_by": "Admin"
		          },
		          {
		            "id": 101,
		            "name": "Famoustower.jpg",
		            "url": "https://www.worldfamousthings.com/wp-content/uploads/2018/01/Leaning-Tower-of-Pisa-Italy.jpg",
		            "type": "image/jpg",
		            "dimmension": "2000x2000",
		            "size": "763300",
		            "photo_by": "Admin"
		          }
		        ]
		      },
		      {
		        "id": 20,
		        "name": "Document",
		        "children": []
		      },
		      {
		        "id": 30,
		        "name": "Videos",
		        "children": [
		          {
		            "id": 301,
		            "name": "GODZILLA MINUS ONE Official Trailer",
		            "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
		            "type": "video/mp4",
		            "dimmension": "2000x2000",
		            "size": "763300",
		            "photo_by": "Admin"
		          },
		          {
		            "id": 302,
		            "name": "Marvel Studios’ Loki Season 2 ",
		            "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
		            "type": "video/mp4",
		            "dimmension": "2000x2000",
		            "size": "763300",
		            "photo_by": "Admin"
		          },
		          {
		            "id": 303,
		            "name": "THE BOY AND THE HERON | Official Teaser Trailer",
		            "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
		            "type": "video/mp4",
		            "dimmension": "2000x2000",
		            "size": "763300",
		            "photo_by": "Admin"
		          }
		        ]
		      }
		    ]
		  },
		  {
		    "id": 2,
		    "name": "Sources",
		    "children": []
		  },
		  {
		    "id": 3,
		    "name": "Shared",
		    "children": [{
		            "id": 3041,
		            "name": "THE BOY AND THE HERON | Official Teaser Trailer",
		            "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
		            "type": "video/mp4",
		            "dimmension": "2000x2000",
		            "size": "763300",
		            "photo_by": "Admin"
		          }]
		  }
		],
		searchFolders:[],
		dataFolders:[],
		menuFolders:[],
		sizeUsed:0
    },

    getters: {

    	getMenuFolder(state) {

			// Tạo bản sao 
  			const originalData = JSON.parse(JSON.stringify(state.listFolders));

			// Hàm đệ quy để loại bỏ các children không mong muốn từ mỗi đối tượng
			function removeUnwantedChildren(obj) {

			    if (obj.children && obj.children.length > 0) {

			      	// Thêm trường totalfile cho đối tượng hiện tại
			      	obj.totalfile = obj.children.length;

			      	// Lọc chỉ giữ lại các children
			      	obj.children = obj.children.filter(child => !child.size || !child.type);

			      	// Gọi đệ quy cho từng children còn lại
			      	obj.children.forEach(child => removeUnwantedChildren(child));

			    } else {
			      	// Nếu không có children, set totalfile là 0
			      	obj.totalfile = 0;
			    }
			}

			// Áp dụng hàm đệ quy cho mỗi đối tượng trong mảng gốc
			const menuFolders = originalData.map(obj => {

			const newObj = { ...obj };

			removeUnwantedChildren(newObj);

			    return newObj;

			});
			return menuFolders;
		},

    	getListDataFolder(state){

    		return state.dataFolders;
    	},

    	getListFolder(state){

    		return state.listFolders;
    	},

    	getSizeUsed(state) {

			const calculateTotalSize = (folder) =>

	        folder.children.reduce((total, item) => {

	          	if (item.children && item.children.length > 0) {

	            	return total + calculateTotalSize(item);

	          	} else {

	            	const size = parseInt(item.size);

	            	return !isNaN(size) ? total + size : total;
	          	}

	        }, 0);

		    const byteUsed =  calculateTotalSize({ children: state.listFolders });
			
			const totalDisk = 2; // 2 GB

			const usedPercentage = (byteUsed / (totalDisk * 1024 * 1024 * 1024)) * 100;

		    const percentage = usedPercentage.toFixed(2);

			return {
				totalDisk:totalDisk,
				totalUsed:percentage
			};

		},

		getSearchFolder(state){
			return state.searchFolders;
		}
    },

	actions: {

		// tìm kiếm data
	  	async searchDataFolder({ commit, state }, payload) {

	  		if(!payload){

		    	return commit("SET_SEARCHFOLDER", []);
	  		}
		    const searchResult = [];

		    const searchInFolder = (item) => {

		      	if (item.name && item.dimmension && 
		      		(item.name.toLowerCase().includes(payload.toLowerCase()) || 
		      		item.type.toLowerCase().includes(payload.toLowerCase())  ||
		      		item.size.toLowerCase().includes(payload.toLowerCase())  ||
		      		item.dimmension.toLowerCase().includes(payload.toLowerCase())  ||
		      		item.photo_by.toLowerCase().includes(payload.toLowerCase()))) {
		      
			        	searchResult.push({
				          id: item.id,
				          name: item.name,
				          dimmension: item.dimmension,
				          size: item.size,
				          url: item.url,
				          type: item.type,
				          photo_by: item.photo_by,

			        	});
		      	}

		      	if (item.children && item.children.length > 0) {

		        	item.children.forEach(searchInFolder);
		      	}
		    };

		    state.listFolders.forEach(searchInFolder);

		    // Commit mutation để cập nhật state
		    return commit("SET_SEARCHFOLDER", searchResult);
	  	},

	  	// find data ID
	  	async findIdDataFolder({ commit,state }, folderId) {

	  		if(!folderId) commit("SET_SEARCHFOLDER", results);

	  		const results = [];

			// Tạo bản sao 
			const originalDataCopy = [...state.listFolders];

			// Định nghĩa hàm đệ quy để tìm con theo id
			function findChildren(node) {

			  	if (node.id === folderId) {

				    // Lọc và giảm kết quả thành một mảng duy nhất
				    results.push(...(node.children || []).filter((child) => child.type && child.dimmension && child.size));
				    return;
			  	}

			  	if (node.children && node.children.length > 0) {

			    	node.children.forEach(findChildren);
			  	}	
			}

			// Gọi hàm đệ quy cho mỗi nút gốc trong originalDataCopy
			originalDataCopy.forEach(findChildren);

			// Commit mutation để cập nhật state
		    return commit("SET_SEARCHFOLDER", results);
	  	},

	  	// tất cả data mặc định trong folder upload
	  	async defaultItemDataFolder({ commit,state }){

	  		const originalDataCopy = [...state.listFolders];

			function findItems(node, acc) {

			    if (node.children && node.children.length > 0 ) {

			      	for (const child of node.children) {

				        if (child.id && child.name && child.photo_by && child.size && child.type && child.dimmension) {

				          acc.push(child);

				        }

			        	findItems(child, acc);
			      	}
			    }
			}

			const findFolderUploads = originalDataCopy.find((elementData) => elementData.name === 'Uploads');

			const itemsWithAttributes = findFolderUploads.children.reduce((acc, folder) => {

			    findItems(folder, acc);

			    return acc;

			}, []);

			// Commit mutation để cập nhật state
		    return commit("SET_SEARCHFOLDER", itemsWithAttributes);
		}
	  	
	},

    mutations: {

    	SET_SEARCHFOLDER(state,data){

    		if(data){

    			return state.dataFolders = data;
    		}
      	},

    }

}